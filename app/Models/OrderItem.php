<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'quantity',
        'price'
    ];

    /**
     * Relação: Este item pertence a uma Encomenda (Order).
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relação: Este item pertence a um Produto (Product).
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
