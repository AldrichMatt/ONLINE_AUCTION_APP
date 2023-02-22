<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 * <\App\Models\Model>
 */
class auctionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'item_id' => fake()->numberBetween(0,10),
            'auction_date' => fake()->date(),
            'starting_price' => fake()->numberBetween(100000, 20000000),
            'status' => fake()->numberBetween(0,1)
        ];
    }
}
