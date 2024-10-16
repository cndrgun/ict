<?php

namespace Database\Seeders;

use Database\Factories\ProductsFactory;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Products::factory()->count(500)->create();
    }
}
