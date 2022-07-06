<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    
    
    public function run()
    {
        
        // \App\Models\User::factory(2)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Abdallah Aboudeif'
        //     'email' => 'comfocom@gmail.com',
        // ]);

        \App\Models\User::insert([
            'name' => 'Abdallah Aboudeif',
            'email' => 'comofcom@gmail.com',
            'profile_photo_path' => '',
            'email_verified_at' => now(),
            'usertype' => false,
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::insert([
            'name' => 'admin',
            'email' => 'admin@edraakmc.com',
            'profile_photo_path' => '',
            'email_verified_at' => now(),
            'usertype' => true,
            'password' => bcrypt('edraakMC_admin'),
            'remember_token' => Str::random(10),
        ]);

        // call the seeder for the categories table
        $this->call(CategoriesSeeder::class);
        // call the seeder for the subcategories
        $this->call(SubcategoriesSeeder::class);
        // call the factory for the products
        \App\Models\Product::factory(250)->create();
        // call the seeder for the product_variances
        \App\Models\Product_variance::factory(750)->create();
        // call the seeder for the product_media
        \App\Models\Product_media::factory(1000)->create();
       
    }
}   