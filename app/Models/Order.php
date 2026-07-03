<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'street', 'city', 'postal_code', 'total_price', 'status'
    ];
}
