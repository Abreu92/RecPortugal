<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ProductVariant;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'price', 'stock', 'image_path', 'is_active'
    ];

    public function variants(): HasMany
    {
        return $this->hasMany('App\Models\ProductVariant');
    }
}
