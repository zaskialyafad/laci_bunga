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
        'sku',
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
    ];

    protected $attributes = [
        'price' => 0,
        'stock' => 0,
    ];

    // satu variasi punya satu produk
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getVariationNameAttribute()
    {
        $parts = array_filter([$this->color, $this->size]);
        return implode(' - ', $parts) ?: 'Default';
    }

}