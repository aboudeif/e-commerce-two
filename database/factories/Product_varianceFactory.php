<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Product_varianceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product = \App\Models\Product::all()->random();
        $size = ['S', 'M', 'L', 'XL', 'XXL'];
        return [
            'product_id' => $product->id,
            'price' => $this->faker->randomFloat(2, 0, 100),
            'color' => $this->faker->colorName,
            'size' => $size[array_rand($size)],
            'quantity' => $this->faker->numberBetween(1, 1000),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            
        ];
    }
}
