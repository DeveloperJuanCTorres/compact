<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $fillable = [
        'id', 'status', 'total', 'customer_name', 'customer_email', 'customer_phone', 'customer_address'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
