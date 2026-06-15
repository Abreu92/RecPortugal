<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Adiciona a coluna role com valor padrão 'user'
            $table->string('role')->default('user');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Se precisares de reverter, removemos a coluna
            $table->dropColumn('role');
        });
    }
};
