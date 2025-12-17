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
    'image',
    ];

    protected $guarded = ['id'];
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function product_variation(){
        return $this->hasMany(Product_variation::class, 'product_id', 'id');
    }
}

