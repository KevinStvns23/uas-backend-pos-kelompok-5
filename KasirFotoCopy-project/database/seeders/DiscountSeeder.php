<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discount; 

class DiscountSeeder extends Seeder
{
    public function run(): void
    {
        $discounts = [
            [
                'promo_name' => 'Diskon Anak Sekolah', 
                'percentage' => 10, 
                'is_active' => 1
            ],
            [
                'promo_name' => 'Promo Cuci Gudang', 
                'percentage' => 20, 
                'is_active' => 1
            ],
        ];

        foreach ($discounts as $item) {
            Discount::updateOrCreate(
                ['promo_name' => $item['promo_name']], 
                $item
            );
        }
    }
}