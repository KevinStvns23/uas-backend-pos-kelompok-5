<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit; 

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            ['name' => 'Pcs'],
            ['name' => 'Pack'],
            ['name' => 'Roll'],
            ['name' => 'Lembar'],
            ['name' => 'Botol'],
        ];

        foreach ($units as $item) {
            Unit::updateOrCreate(
                ['name' => $item['name']], 
                $item
            );
        }
    }
}