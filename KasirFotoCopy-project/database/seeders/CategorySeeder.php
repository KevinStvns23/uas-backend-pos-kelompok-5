<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Kertas & Buku',
            'description' => 'Berbagai macam kertas untuk kebutuhan cetak dan buku untuk keperluan tulis maupun gambar.'
        ]);

        Category::create([
            'name' => 'Alat Tulis Kantor (ATK)',
            'description' => 'Peralatan tulis standar yang digunakan untuk mendukung kegiatan operasional harian sekolah dan kantor.'
        ]);

        Category::create([
            'name' => 'Perlengkapan Jilid',
            'description' => 'Material dan peralatan fisik yang digunakan untuk merakit, menjilid, dan merapikan dokumen.'
        ]);

        Category::create([
            'name' => 'Aksesoris Komputer',
            'description' => 'Perangkat keras tambahan dan persediaan habis pakai untuk kebutuhan operasional komputer dan mesin cetak.'
        ]);

        Category::create([
            'name' => 'Jasa Cetak & Kasir',
            'description' => 'Layanan pencetakan dokumen bagi pelanggan serta perlengkapan pendukung transaksi pembayaran.'
        ]);
    }
}