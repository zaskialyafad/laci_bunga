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
                 'stock' => 20,
                 'sku' => 'DRS-M-RED-001',
                 'created_at' => now(),
                 'updated_at' => now(),
            ],
            [
                'product_id' => 1, 
                'size' => 'L',
                'color' => 'Biru', 
                'stock' => 20,
                'sku' => 'DRS-L-BLU-002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                 'size' => 'S',
                'color' => 'Hijau', 
                'stock' => 20,
                'sku' => 'CRD-S-GRN-003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3, 
                'size' => 'M',
                'color' => 'Kuning', 
                'stock' => 20,
                'sku' => 'BLS-M-YEL-004',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4, 
                'size' => 'L',
                'color' => 'Putih', 
                'stock' => 20,
                'sku' => 'SKRT-L-WHT-005',
                'created_at' => now(),
                'updated_at' => now(), 
                
            ],
            [
                'product_id' => 5,
                'size' => 'All Size',
                'color' => 'Coklat',
                'stock' => 20,
                'sku' => 'BLS-ALL-BROWN-006',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        Product_variation::insert($data);
    }
}
