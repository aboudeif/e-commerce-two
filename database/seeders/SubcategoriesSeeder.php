<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = \App\Models\Category::all();
        $subcategories = [];
        foreach($categories as $category) {
             
            $subcategories[] =[
            'name' => 'معاطف',
            'description' => 'تسوق أغلي وأفخم المعاطف والسترات والبلطو',
            'category_id' => $category->id,
            'created_at' => now(),
            'updated_at' => now(),
    
            ];
            $subcategories[] =[
            'name' => 'بناطيل',
            'description' => 'أفضل البناطيل لجميع الأزواق والأعمار',
            'category_id' => $category->id,
            'created_at' => now(),
            'updated_at' => now(),
    
            ];
            $subcategories[] =[
        
            'name' => 'بلايز',
            'description' => 'القمصان الشبابية والأنيقة',
            'category_id' => $category->id,
            'created_at' => now(),
            'updated_at' => now(),
            ];
            $subcategories[] =[
            'name' => 'أحذية',
            'description' => 'الأحذية المريحة الرياضية والكلاسيكية والمناسبة لجميع الأعمال',
            'category_id' => $category->id,
            'created_at' => now(),
            'updated_at' => now(),
            ];
            $subcategories[] =[
            'name' => 'حقائب',
            'description' => 'الحقائب الجلدية والقماشية ',
            'category_id' => $category->id,
            'created_at' => now(),
            'updated_at' => now(),
            ];
            $subcategories[] =[
            'name' => 'مستلزمات',
            'description' => 'جميع المستلزمات المناسبة في مكان واحد',
            'category_id' => $category->id,
            'created_at' => now(),
            'updated_at' => now(),
            ];
        }
        
        DB::table('subcategories')->insert($subcategories);
    }
}
