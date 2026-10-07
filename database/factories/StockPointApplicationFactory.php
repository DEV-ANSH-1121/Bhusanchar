<?php

namespace Database\Factories;

use App\Models\StockPointApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockPointApplication>
 */
class StockPointApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'applicant_name' => fake()->name(),
            'business_name' => fake()->company(),
            'email' => fake()->safeEmail(),
            'mobile' => fake()->numerify('98########'),
            'state' => fake()->state(),
            'district' => fake()->city(),
            'block' => fake()->city(),
            'panchayat' => fake()->city(),
            'business_address' => fake()->address(),
        ];
    }
}
