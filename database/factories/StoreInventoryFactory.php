<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreInventory>
 */
class StoreInventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(), // Generates a store and associates it
            'product_id' => Product::factory(), // Generates a product and associates it
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => fake()->numberBetween(100,1000),
            // 'rating' => $this->faker->randomFloat(1, 1, 5), // 1 decimal point between 1 and 5
        ];
    }
}
