<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(),
            'branch' => fake()->city(),
            'address' => fake()->address(),
            'phone' => fake()->numerify('+91 ##########'),
            'email' => fake()->safeEmail(),
            'working_hours' => 'Mon - Sat: 9:30 AM - 6:30 PM',
            'map_embed_url' => fake()->url(),
        ];
    }
}
