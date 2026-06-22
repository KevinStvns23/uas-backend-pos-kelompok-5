<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'invoice_number' => 'INV-001',
                'total_price' => 90000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'invoice_number' => 'INV-002',
                'total_price' => 40000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'invoice_number' => 'INV-003',
                'total_price' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'invoice_number' => 'INV-004',
                'total_price' => 45000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'invoice_number' => 'INV-005',
                'total_price' => 36000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'invoice_number' => 'INV-006',
                'total_price' => 51000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'invoice_number' => 'INV-007',
                'total_price' => 75000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'invoice_number' => 'INV-008',
                'total_price' => 48000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'invoice_number' => 'INV-009',
                'total_price' => 30000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'invoice_number' => 'INV-010',
                'total_price' => 65000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}