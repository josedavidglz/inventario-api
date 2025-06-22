<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->warn('No hay categorías. Ejecuta primero CategorySeeder.');
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            Product::create([
                'category_id' => $categories->random()->id,
                'name'        => $faker->words(3, true), // ejemplo: "Cámara digital compacta"
                'description' => $faker->sentence(12),
                'price'       => $faker->randomFloat(2, 10000, 500000),
                'stock'       => $faker->numberBetween(1, 100),
            ]);
        }
    }
}
