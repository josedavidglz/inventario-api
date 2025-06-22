<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $categories = [
            ['name' => 'Electrónica', 'description' => 'Dispositivos electrónicos y gadgets.'],
            ['name' => 'Ropa', 'description' => 'Prendas de vestir para todas las edades.'],
            ['name' => 'Hogar', 'description' => 'Artículos para el hogar y decoración.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
