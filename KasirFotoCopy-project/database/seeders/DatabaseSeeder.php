<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UnitSeeder::class,           
            DiscountSeeder::class,      
            CategorySeeder::class,     
            SubCategorySeeder::class,   
            ProductSeeder::class,      
        ]);
    }
}