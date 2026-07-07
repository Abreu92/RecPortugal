<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'street', 'city', 'postal_code', 'total_price', 'status'
    ];

    /**
     * Define a relação: Uma Encomenda tem vários itens.
     * Isto permite usar $order->items no controlador.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
