<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Store;
use App\Models\StoreInventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'store_id' => Store::factory(),
            'store_inventory_id' =>'-1'
        ];
    }

    /**
     * Configure the factory.
     *
     * @return $this
     */

    public function configure()
    {
        return $this->afterCreating(function ($transaction) {
            $transaction->store_inventory_id = StoreInventory::factory()->create([
                'store_id' => $transaction->store_id,
            ])->id;

            $transaction->save();
        });
    }
}
