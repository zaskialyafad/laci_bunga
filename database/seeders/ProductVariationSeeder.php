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
    $variations = [];
    for ($i = 1; $i <= 20; $i++) {
        // Menambahkan 2 variasi per produk (Misal: S/M dan L/XL atau warna berbeda)
        $variations[] = [
            'product_id' => $i,
            'size' => ($i > 15) ? 'All Size' : 'S/M', // Aksesoris biasanya All Size
            'color' => 'Muted Sage',
            'stock' => 15,
            'price' => ($i > 15) ? 125000 : 385000,
            'sku' => "LB-".str_pad($i, 3, '0', STR_PAD_LEFT)."-SG",
            'created_at' => now(), 'updated_at' => now(),
        ];
        $variations[] = [
            'product_id' => $i,
            'size' => ($i > 15) ? 'All Size' : 'L/XL',
            'color' => 'Dusty Rose',
            'stock' => 10,
            'price' => ($i > 15) ? 125000 : 385000,
            'sku' => "LB-".str_pad($i, 3, '0', STR_PAD_LEFT)."-DR",
            'created_at' => now(), 'updated_at' => now(),
        ];
    }
    Product_variation::insert($variations);
}
}
