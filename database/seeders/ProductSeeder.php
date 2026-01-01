<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            [
                'product_name' => 'Floral Summer Dress',
                'category_id' => 1,
                'description' => 'Dress with a vibrant floral pattern, perfect for summer outings.',
                'status' => 'show',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Cozy Knit Cardigan',
                'category_id' => 2,
                'description' => 'Warm and comfortable knit cardigan, ideal for chilly days.',
                'status' => 'show',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Silk Blouse',
                'category_id' => 3,
                'description' => 'Elegant silk blouse with a smooth texture, suitable for formal occasions.',
                'status' => 'show',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Pleated Skirt',
                'category_id' => 4,
                'description' => 'Stylish pleated skirt that adds a touch of elegance to any outfit.',
                'status' => 'show',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Leather Belt',
                'category_id' => 5,
                'description' => 'Classic leather belt that complements any outfit.',
                'status' => 'show',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Product::insert($data);
    }
}
