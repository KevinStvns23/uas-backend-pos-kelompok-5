<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_details')->insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'quantity' => 5,
                'price' => 18000,
                'subtotal' => 90000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'product_id' => 11,
                'quantity' => 10,
                'price' => 4000,
                'subtotal' => 40000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'product_id' => 5,
                'quantity' => 1,
                'price' => 25000,
                'subtotal' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 4,
                'product_id' => 9,
                'quantity' => 3,
                'price' => 15000,
                'subtotal' => 45000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 5,
                'product_id' => 6,
                'quantity' => 6,
                'price' => 6000,
                'subtotal' => 36000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 6,
                'product_id' => 7,
                'quantity' => 6,
                'price' => 8500,
                'subtotal' => 51000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 7,
                'product_id' => 25,
                'quantity' => 1,
                'price' => 75000,
                'subtotal' => 75000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 8,
                'product_id' => 8,
                'quantity' => 6,
                'price' => 8000,
                'subtotal' => 48000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 9,
                'product_id' => 10,
                'quantity' => 3,
                'price' => 10000,
                'subtotal' => 30000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 10,
                'product_id' => 23,
                'quantity' => 1,
                'price' => 65000,
                'subtotal' => 65000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}