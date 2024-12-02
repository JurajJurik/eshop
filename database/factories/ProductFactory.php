<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::ucfirst(fake()->words(5, true)),
            'short_description' => fake()->text(150),
            'description' => fake()->text(800),
            'manufacturer' => fake()->deviceManufacturer,
            'platform' => fake()->devicePlatform,
            'serial_number' => fake()->deviceSerialNumber,
        ];
    }
}
