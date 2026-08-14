<?php

namespace Database\Factories;

use App\Models\SeoMeta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SeoMeta>
 */
class SeoMetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'page_name' => fake()->unique()->slug(),
            'meta_title' => fake()->sentence(),
            'meta_description' => fake()->paragraph(),
            'meta_keywords' => implode(', ', fake()->words(5)),
        ];
    }
}
