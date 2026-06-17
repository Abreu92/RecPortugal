<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'price', 'stock', 'image_path', 'is_active'
    ];

    /**
     * Define a relação: Um produto pode ter várias imagens associadas.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
