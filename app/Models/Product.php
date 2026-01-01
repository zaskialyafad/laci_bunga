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
    'product_name',
    'category_id',       
    'description',
    'status',
    ];

    protected $attributes = [
        'status' => 'show',
    ]; 

    // Relasi ke model Category many to one
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi ke model Product_variation one to many
    public function product_variation(){
        return $this->hasMany(Product_variation::class, 'product_id');
    }

    // Relasi ke model gambar_produk one to many
    public function gambar_produk(){
        return $this->hasMany(Gambar_produk::class, 'product_id', );
    }
    
    // Relasi ke model gambar_produk one to one. Gambar yang primary
    public function primaryImage(){
        return $this->hasOne(Gambar_produk::class,'product_id', 'id')->where('is_primary', true);
    }

     public function ambilPrimaryImage()
    {
        $primaryImage = $this->gambar_produk()->where('is_primary', true)->first();
        
        if ($primaryImage) {
            return asset('assets/img/products/' . $primaryImage->image);
        }
        
        return asset('assets/img/no-image.png');
    }

    protected $guarded = ['id'];
}
    

