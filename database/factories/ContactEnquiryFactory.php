<?php

namespace Database\Factories;

use App\Enums\InquiryType;
use App\Models\ContactEnquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactEnquiry>
 */
class ContactEnquiryFactory extends Factory
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
            'product_interested' => fake()->words(2, true),
            'state' => fake()->state(),
            'district' => fake()->city(),
            'block' => fake()->city(),
            'inquiry_type' => fake()->randomElement(InquiryType::cases()),
            'message' => fake()->paragraph(),
        ];
    }
}
