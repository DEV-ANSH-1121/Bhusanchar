<?php

namespace Database\Factories;

use App\Models\FarmerHelpCard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FarmerHelpCard>
 */
class FarmerHelpCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'mobile' => fake()->numerify('98########'),
            'state' => fake()->state(),
            'district' => fake()->city(),
            'block' => fake()->city(),
            'village' => fake()->city(),
            'preferred_bhusanchar_point' => fake()->company(),
        ];
    }
}
