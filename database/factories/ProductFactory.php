<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'category_id' => Category::factory()->create(),
            'name' => $this->faker->word(),
            'description' => $this->faker->text(30),
            'price' => $this->faker->randomNumber(5),
            'image' => $this->faker->imageUrl(),
            'quantity' => $this->faker->randomNumber(2),
            'have_instock' => $this->faker->boolean(),
        ];
    }
}
