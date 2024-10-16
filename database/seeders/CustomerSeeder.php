<?php

namespace Database\Seeders;

use Database\Factories\CustomersFactory;
use Database\Factories\ProductsFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Customers::factory()->count(50)->create();
    }
}
