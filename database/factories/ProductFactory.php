<?php

namespace Database\Factories;

use App\Models\Subcategory;
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
        $subcat_name = $subcategory->name;
        $type = ['قميص','بنطال','جاكيت','سويتر','بلوزة','حذاء','كوتشي',' حقيبة قماشية','معطف','حقيبة جلدية'];
        $letter = ['ا','ب','ت','ث','ج',' ','ح','خ','د','ذ','ر','ز','س','ش','ص','ض',' ','ط','ظ','ع','غ','ف','ق','ك','ل',' ','م','ن','ه','و','ى','ئ','ؤ','ة'];
        $name = '';
        for($i=0;$i<5;$i++)
            $name .= $letter[array_rand($letter)];
        
        return [
            // 
            'subcategory_id' => $subcategory,
            'name' => $type[array_rand($type)].' '.$name,
            'price' => $this->faker->randomFloat(2, 99, 5000),
            'description' => $this->faker->text(100),
            'created_at' =>  $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' =>  $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
