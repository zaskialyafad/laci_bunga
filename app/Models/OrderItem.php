<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    
    protected $fillable = [
        'order_id', 
        'product_id', 
        'product_variation_id', 
        'quantity', 
        'price'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function product_variation() {
        return $this->belongsTo(Product_variation::class, 'product_variation_id');
    }


}
