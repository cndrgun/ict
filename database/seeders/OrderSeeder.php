<?php

namespace Database\Seeders;

use App\Models\OrderProducts;
use App\Models\Products;
use Database\Factories\OrderFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Orders::factory()->count(10)->create()->each(function ($order) {
            $products = Products::inRandomOrder()->limit(rand(1, 5))->get();

            foreach ($products as $product) {
                OrderProducts::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                ]);
            }
        });
    }
}
