<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gambar_produk;

class GambarProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        // Looping dari ID 6 sampai 25 sesuai data di database Anda
        for ($i = 6; $i <= 25; $i++) {
            
            // Logika untuk menentukan nama file gambar (1.png - 20.png)
            // Karena ID mulai dari 6, maka (6 - 5) = gambar 1.png, (25 - 5) = gambar 20.png
            $imageNumber = $i - 5; 

            $data[] = [
                'product_id' => $i,
                'image'      => $imageNumber . '.png',
                'is_primary' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Gambar_produk::insert($data);
    }
}