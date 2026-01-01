<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class gambar_produk extends Model
{
    use HasFactory;
    protected $table = 'gambar_produks';

    protected $fillable = [
        'product_id', 
        'image',
        'is_primary'];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    // default value
    protected $attributes = [
        'is_primary' => true,
    ];

     // Relasi ke model Product many to one
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function ambulUrlGambar()
    {
        return asset('storage/products/' . $this->image);
    }
}
