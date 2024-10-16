<?php

namespace Database\Factories;

use App\Models\Customers;
use App\Models\Orders;
use App\Models\OrderStatuses;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrderFactory extends Factory
{
    protected $model = Orders::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customers::inRandomOrder()->first()->id,
            'order_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'order_no' => $this->faker->numerify('##########'),
            'shipment_address' => $this->faker->text(500),
            'status_id' => OrderStatuses::inRandomOrder()->first()->id,
        ];

    }
}
