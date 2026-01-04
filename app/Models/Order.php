<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [ 
        'order_number',
        'user_id',
        'receiver_name', 
        'phone',
        'address',
        'total_price',
        'snap_token',
        'payment_status'
    ];
}
