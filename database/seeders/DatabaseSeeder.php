<?php

namespace Database\Seeders;

use App\Models\OrderStatuses;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProductSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(OrderStatusesSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
