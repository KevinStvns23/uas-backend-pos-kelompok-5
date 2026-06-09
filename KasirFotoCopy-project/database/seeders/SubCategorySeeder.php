<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubCategory;

class SubCategorySeeder extends Seeder
{
    public function run(): void
    {
        SubCategory::create([
            'category_id' => 1,
            'name' => 'Kertas Print',
            'description' => 'Kertas HVS berbagai ukuran (A4, F4, A3) untuk kebutuhan pencetakan dan penggandaan dokumen.'
        ]);

        SubCategory::create([
            'category_id' => 1,
            'name' => 'Buku Tulis',
            'description' => 'Buku tulis bergaris, buku kotak, dan buku catatan untuk keperluan administrasi sekolah atau kantor.'
        ]);

        SubCategory::create([
            'category_id' => 1,
            'name' => 'Buku Gambar',
            'description' => 'Buku gambar dan sketsa berbagai ukuran untuk keperluan seni, desain, dan arsitektur.'
        ]);

        SubCategory::create([
            'category_id' => 2,
            'name' => 'Alat Tulis Dasar',
            'description' => 'Pensil, pulpen, penghapus, penggaris, dan perlengkapan tulis esensial lainnya.'
        ]);

        SubCategory::create([
            'category_id' => 2,
            'name' => 'Spidol & Tinta',
            'description' => 'Spidol papan tulis, spidol permanen, pena highlighter, serta tinta isi ulang.'
        ]);

        SubCategory::create([
            'category_id' => 2,
            'name' => 'Pewarna',
            'description' => 'Pensil warna, krayon, cat air, dan perlengkapan mewarnai lainnya.'
        ]);

        SubCategory::create([
            'category_id' => 3,
            'name' => 'Map & Folder',
            'description' => 'Map plastik, map kertas, map snelhecter, dan folder untuk pengarsipan dokumen.'
        ]);

        SubCategory::create([
            'category_id' => 3,
            'name' => 'Perekat & Lakban',
            'description' => 'Lem kertas, selotip transparan, lakban hitam, dan double tape berbagai ukuran.'
        ]);

        SubCategory::create([
            'category_id' => 3,
            'name' => 'Cover Jilid',
            'description' => 'Plastik mika transparan, kertas buffalo, dan lakban jilid untuk kebutuhan sampul dokumen.'
        ]);

        SubCategory::create([
            'category_id' => 4,
            'name' => 'Penyimpanan (USB)',
            'description' => 'Flashdisk, kartu memori, dan perangkat penyimpanan data digital portabel lainnya.'
        ]);

        SubCategory::create([
            'category_id' => 4,
            'name' => 'Perangkat Keras',
            'description' => 'Mouse, keyboard, mousepad, dan kabel aksesori pendukung komputer.'
        ]);

        SubCategory::create([
            'category_id' => 4,
            'name' => 'Tinta Printer',
            'description' => 'Tinta printer cair berbagai warna, cartridge, dan toner untuk mesin cetak.'
        ]);

        SubCategory::create([
            'category_id' => 5,
            'name' => 'Jasa Fotokopi',
            'description' => 'Layanan penggandaan dokumen fisik, baik hitam putih maupun berwarna.'
        ]);

        SubCategory::create([
            'category_id' => 5,
            'name' => 'Jasa Print',
            'description' => 'Layanan pencetakan dokumen teks atau gambar dari file digital.'
        ]);

        SubCategory::create([
            'category_id' => 5,
            'name' => 'Perlengkapan Kasir',
            'description' => 'Kertas struk termal, pita printer kasir, mesin kalkulator, dan buku nota bon.'
        ]);
    }
}