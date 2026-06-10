<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Unit;
use App\Models\Discount;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $productMapping = [
            ['name' => 'Baterai ABC Alkaline AA', 'price' => 16000, 'stock' => 30, 'sub' => 'Perangkat Keras', 'unit' => 'Pcs', 'discount' => null],
            ['name' => 'Buku Gambar A3 Sidu', 'price' => 8000, 'stock' => 15, 'sub' => 'Buku Gambar', 'unit' => 'Lembar', 'discount' => null],
            ['name' => 'Buku Gambar A4 Sidu', 'price' => 5000, 'stock' => 20, 'sub' => 'Buku Gambar', 'unit' => 'Lembar', 'discount' => 'Promo Cuci Gudang'],
            ['name' => 'Cutter Kenko L-500', 'price' => 15000, 'stock' => 15, 'sub' => 'Alat Tulis Dasar', 'unit' => 'Pcs', 'discount' => null],
            ['name' => 'Double Tape 1 Inch', 'price' => 6000, 'stock' => 35, 'sub' => 'Perekat & Lakban', 'unit' => 'Roll', 'discount' => null],
            ['name' => 'Flashdisk SanDisk 32GB', 'price' => 65000, 'stock' => 8, 'sub' => 'Penyimpanan (USB)', 'unit' => 'Pcs', 'discount' => 'Diskon Anak Sekolah'],
            ['name' => 'Gunting Sedang Joyko', 'price' => 8000, 'stock' => 16, 'sub' => 'Alat Tulis Dasar', 'unit' => 'Pcs', 'discount' => null],
            ['name' => 'Isi Cutter Kenko Besar', 'price' => 8000, 'stock' => 20, 'sub' => 'Alat Tulis Dasar', 'unit' => 'Pack', 'discount' => null],
            ['name' => 'Jasa Fotokopi A4 (Hitam Putih)', 'price' => 500, 'stock' => 9999, 'sub' => 'Jasa Fotokopi', 'unit' => 'Lembar', 'discount' => null],
            ['name' => 'Jasa Print A4 Hitam Putih', 'price' => 500, 'stock' => 9999, 'sub' => 'Jasa Print', 'unit' => 'Lembar', 'discount' => null],
            ['name' => 'Mouse Kabel Logitech B100', 'price' => 55000, 'stock' => 4, 'sub' => 'Perangkat Keras', 'unit' => 'Pcs', 'discount' => 'Promo Cuci Gudang'],
            ['name' => 'Penggaris Plastik Butterfly 30cm', 'price' => 3000, 'stock' => 48, 'sub' => 'Alat Tulis Dasar', 'unit' => 'Pcs', 'discount' => null],
            ['name' => 'Penghapus Papan Tulis (Whiteboard)', 'price' => 6000, 'stock' => 30, 'sub' => 'Alat Tulis Dasar', 'unit' => 'Pcs', 'discount' => null],
            ['name' => 'Pensil 2B Faber Castell', 'price' => 4000, 'stock' => 120, 'sub' => 'Alat Tulis Dasar', 'unit' => 'Pcs', 'discount' => 'Diskon Anak Sekolah'],
            ['name' => 'Pensil Warna Faber Castell 12', 'price' => 22000, 'stock' => 14, 'sub' => 'Pewarna', 'unit' => 'Pack', 'discount' => null],
            ['name' => 'Plastik Mika Jilid A4', 'price' => 38000, 'stock' => 2, 'sub' => 'Cover Jilid', 'unit' => 'Pack', 'discount' => null],
            ['name' => 'Pulpen Standard AE7 Hitam', 'price' => 2000, 'stock' => 150, 'sub' => 'Alat Tulis Dasar', 'unit' => 'Pcs', 'discount' => 'Diskon Anak Sekolah'],
            ['name' => 'Rautan (Peruncing) Meja Kenko', 'price' => 25000, 'stock' => 4, 'sub' => 'Alat Tulis Dasar', 'unit' => 'Pcs', 'discount' => null],
            ['name' => 'Rautan Pensil Putar Joyko', 'price' => 18000, 'stock' => 3, 'sub' => 'Alat Tulis Dasar', 'unit' => 'Pcs', 'discount' => null],
            ['name' => 'Spidol Boardmarker Hitam', 'price' => 8500, 'stock' => 35, 'sub' => 'Spidol & Tinta', 'unit' => 'Pcs', 'discount' => null],
            ['name' => 'Spidol Boardmarker Merah', 'price' => 8500, 'stock' => 35, 'sub' => 'Spidol & Tinta', 'unit' => 'Pcs', 'discount' => null],
        ];

        foreach ($productMapping as $item) {
            $subCategory = SubCategory::where('name', $item['sub'])->first();
            $unit = $item['unit'] ? Unit::where('name', $item['unit'])->first() : null;
            $discount = $item['discount'] ? Discount::where('promo_name', $item['discount'])->first() : null;

            Product::create([
                'name' => $item['name'],
                'price' => $item['price'],
                'stock' => $item['stock'],
                'sub_category_id' => $subCategory ? $subCategory->id : null,
                'category_id' => $subCategory ? $subCategory->category_id : null,
                'unit_id' => $unit ? $unit->id : null,
                'discount_id' => $discount ? $discount->id : null,
            ]);
        }
    }
}