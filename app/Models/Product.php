<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     use HasFactory;

    /**
     * fillable
     *
     * @var array
     */

    protected $table = 'products';
    protected $fillable = [ 
    'name',
    'category_id',       
    'description',
    'price',
    ];

    // Relasi ke model Category many to one
    public function category_id(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Relasi ke model Product_variation one to many
    public function product_variation(){
        return $this->hasMany(Product_variation::class, 'product_id', 'id');
    }

    // Relasi ke model gambar_produk one to many
    public function Gambar_produk(){
        return $this->hasMany(Gambar_produk::class, 'product_id', 'id');
    }
    // Relasi ke model gambar_produk one to one. Gambar yang primary
    public function primaryImage(){
        return $this->hasOne(Gambar_produk::class,'product_id', 'id')->where('is_primary', 1);
    }


    protected $guarded = ['id'];
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
    

