<?php

namespace Database\Factories;

use App\Models\Career;
use App\Models\CareerApplication;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<CareerApplication>
 */
class CareerApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'career_id' => Career::factory(),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'mobile' => fake()->numerify('98########'),
            'resume_path' => 'career-applications/'.Str::uuid().'.pdf',
            'resume_disk' => 'local',
        ];
    }
}
