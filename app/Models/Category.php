<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name', // Hanya nama yang boleh diisi melalui form
    ];

    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}