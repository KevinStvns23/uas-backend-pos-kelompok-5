<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    public function run()
    {
        DB::table('user')->insert([
            'username' => 'owner123',
            'nama_lengkap' => 'Pemilik Toko',
            'password' => Hash::make('12345'),
            'role' => 'Owner',
            'shift' => 'Full',
            'status' => 'Aktif',
            'alamat' => 'Jl. Contoh Alamat No. 123',
            'no_telp' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}