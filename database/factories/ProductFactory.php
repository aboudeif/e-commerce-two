<?php

namespace Database\Factories;

use App\Models\subcategory;
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
    protected $model = \App\Models\Product::class;
    public function definition()
    {

         $subcategory = Subcategory::all()->random();   
               
            
        return [
            // 
            'subcategory_id' => $subcategory,
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
