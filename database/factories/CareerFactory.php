<?php

namespace Database\Factories;

use App\Models\Career;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Career>
 */
class CareerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_title' => fake()->unique()->jobTitle(),
            'job_description' => fake()->paragraph(),
            'eligible_criteria' => [
                fake()->sentence(6),
                fake()->sentence(6),
            ],
            'key_responsibilities' => [
                fake()->sentence(8),
                fake()->sentence(8),
            ],
            'salary' => '₹25,000 – ₹40,000',
            'location' => fake()->city(),
            'last_application_date' => now()->addMonth()->toDateString(),
        ];
    }
}
