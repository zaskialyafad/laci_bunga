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
        'stock',
        'sku',
        'promo',
    ];
    
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // penetua harga promo dengan input presentase diskon
    public function hargaPromo(){
        return $this->product->price - ($this->product->price * $this->promo / 100);
    }
}
