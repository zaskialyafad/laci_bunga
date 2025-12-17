<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_variation extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'product_variations';
    protected $fillable = [
        'product_id',
        'size',
        'color',
        'price',
        'stock',
    ];
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
