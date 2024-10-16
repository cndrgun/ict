<?php

namespace Database\Seeders;

use App\Models\OrderStatuses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderStatuses::insert([ 'status' => 'Yeni', ],['status' => 'Tamamlandı']);
    }
}
