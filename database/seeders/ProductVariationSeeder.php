<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\product_variation;

class ProductVariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            [
                'product_id' => 1,
                 'size' => 'M',
                'color' => 'Merah', 
                 'price' => 299000,
                 'stock' => 20,
                 'created_at' => now(),
                 'updated_at' => now(),
            ],
            [
                'product_id' => 1, 
                'size' => 'L',
                'color' => 'Biru', 
                'price' => 299000,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                 'size' => 'S',
                'color' => 'Hijau', 
                'price' => 299000,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3, 
                'size' => 'M',
                'color' => 'Kuning', 
                'price' => 299000,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4, 
                'size' => 'L',
                'color' => 'Putih', 
                'price' => 299000,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(), 
                
            ],
        ];
        Product_variation::insert($data);
    }
}
