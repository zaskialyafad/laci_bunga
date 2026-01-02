<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $data =[
        ['name' => 'Dress'],
        ['name' => 'Outerwear'], // Cardigan/Outer
        ['name' => 'Tops'],      // Blouse
        ['name' => 'Bottoms'],    // Skirt/Pants
        ['name' => 'Accessories'],
        ['name' => 'Set'],
    ];
    Category::insert($data);
}
}
