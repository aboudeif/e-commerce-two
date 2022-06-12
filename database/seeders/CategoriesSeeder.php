<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seeding the categories
        $categories = [];
        $categories[] =[
            'name' => 'men',
            'description' => 'جميع ملابس الرجال',
            'is_deleted' => 0,
            'created_at' => now(),
            'updated_at' => now(),
            ];
        $categories[] =[
            'name' => 'women',
            'description' => 'جميع مستلزمات النساء',
            'is_deleted' => 0,
            'created_at' => now(),
            'updated_at' => now(),
            ];
        $categories[] =[
            'name' => 'kids',
            'description' => 'مستلزمات وملابس الأطفال',
            'is_deleted' => 0,
            'created_at' => now(),
            'updated_at' => now(),
            ];
        DB::table('categories')->insert($categories);

    }
}
