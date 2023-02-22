<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 * <\App\Models\Model>
 */
class auctionhistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'auction_id' => fake()->numberBetween(0,10),
            'item_id' => fake()->numberBetween(0, 10),
            'user_id' => fake()->numberBetween(0,10),
            'offer_price' => fake()->numberBetween(100000, 20000000)
        ];
    }
}
