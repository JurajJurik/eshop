<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = fake()->dateTimeBetween('-2 years');
        $updatedAt = fake()->dateTimeBetween($createdAt, 'now');

        return [
            'product_id' => null,
            'description' => fake()->paragraph(),
            'rating' => fake()->numberBetween(1, 5),
            'advantages' => json_encode(fake()->words(rand(0,5))),
            'disadvantages' => json_encode(fake()->words(rand(0,5))),
            'helpful' => fake()->numberBetween(2,15),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ];
    }
    public function good() 
    {
        return $this->state(function (array $atrributes) 
        {
            return [
                'rating' => fake()->numberBetween(5,5)
            ];
        });    
    }

    public function average() 
    {
        return $this->state(function (array $atrributes) 
        {
            return [
                'rating' => fake()->numberBetween( 2,4)
            ];
        });    
    }

    public function bad() 
    {
        return $this->state(function (array $atrributes) 
        {
            return [
                'rating' => fake()->numberBetween(1,2)
            ];
        });    
    }
}
