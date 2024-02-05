<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_id' => Brand::factory(),
            'category_id' => Category::factory(),
            'year' => $this->faker->year,
            'name' => $this->faker->word,
            'image' => $this->faker->word,
            'cylinders' => $this->faker->randomNumber(),
            'displacement' => $this->faker->randomFloat(2, 1, 5),
            'drive' => $this->faker->word,
            'fuel_type' => $this->faker->word,
            'city_mpg' => $this->faker->randomNumber(),
            'highway_mpg' => $this->faker->randomNumber(),
            'combination_mpg' => $this->faker->randomNumber(),
            'transmission' => $this->faker->word,
        ];
    }
}
