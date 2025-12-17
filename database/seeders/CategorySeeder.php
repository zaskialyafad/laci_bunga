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
            ['name' => 'Cardigan'],
            ['name' => 'Blouse'],
            ['name' => 'Skirt'],
            ['name' => 'Accessories'],
        ];
        Category::insert($data);
    }
}
