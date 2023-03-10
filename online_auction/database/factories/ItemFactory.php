<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 * <\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'item_name' => fake()->word(),
            'company_name' => fake()->company(),
            'location' => fake()->word(),
            'image' => "/assets/logo-dark.png",
            'input_date' => fake()->date(),
            'initial_price' => fake()->numberBetween(100000, 20000000),
            'description' => fake()->paragraph(5)
        ];
    }
}
