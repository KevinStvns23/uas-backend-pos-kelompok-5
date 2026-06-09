<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Baterai ABC Alkaline AA', 'price' => 16000, 'stock' => 30],
            ['name' => 'Buku Gambar A3 Sidu', 'price' => 8000, 'stock' => 15],
            ['name' => 'Buku Gambar A4 Sidu', 'price' => 5000, 'stock' => 20],
            ['name' => 'Cutter Kenko L-500', 'price' => 15000, 'stock' => 15],
            ['name' => 'Double Tape 1 Inch', 'price' => 6000, 'stock' => 35],
            ['name' => 'Flashdisk SanDisk 32GB', 'price' => 65000, 'stock' => 8],
            ['name' => 'Gunting Sedang Joyko', 'price' => 8000, 'stock' => 16],
            ['name' => 'Isi Cutter Kenko Besar', 'price' => 8000, 'stock' => 20],
            ['name' => 'Jasa Fotokopi A4 (Hitam Putih)', 'price' => 500, 'stock' => 9999],
            ['name' => 'Jasa Print A4 Hitam Putih', 'price' => 500, 'stock' => 9999],
            ['name' => 'Jasa Print A4 Warna', 'price' => 1000, 'stock' => 9999],
            ['name' => 'Kertas Buffalo Warna (Isi 100)', 'price' => 35000, 'stock' => 15],
            ['name' => 'Kertas Folio Bergaris (Isi 100)', 'price' => 18000, 'stock' => 25],
            ['name' => 'Kertas Foto Glossy A4', 'price' => 25000, 'stock' => 4],
            ['name' => 'Kertas Struk Thermal 58mm', 'price' => 5000, 'stock' => 57],
            ['name' => 'Lakban Bening 2 Inch', 'price' => 12000, 'stock' => 40],
            ['name' => 'Lakban Hitam 2 Inch', 'price' => 12000, 'stock' => 50],
            ['name' => 'Map Plastik Kancing (Bening)', 'price' => 4000, 'stock' => 80],
            ['name' => 'Map Snelhecter Kertas (Merah)', 'price' => 1500, 'stock' => 145],
            ['name' => 'Mouse Kabel Logitech B100', 'price' => 55000, 'stock' => 4],
            ['name' => 'Penggaris Plastik Butterfly 30cm', 'price' => 3000, 'stock' => 48],
            ['name' => 'Penghapus Papan Tulis (Whiteboard)', 'price' => 6000, 'stock' => 30],
            ['name' => 'Pensil 2B Faber Castell', 'price' => 4000, 'stock' => 120],
            ['name' => 'Pensil Warna Faber Castell 12', 'price' => 22000, 'stock' => 14],
            ['name' => 'Plastik Mika Jilid A4', 'price' => 38000, 'stock' => 2],
            ['name' => 'Pulpen Standard AE7 Hitam', 'price' => 2000, 'stock' => 150],
            ['name' => 'Rautan (Peruncing) Meja Kenko', 'price' => 25000, 'stock' => 4],
            ['name' => 'Rautan Pensil Putar Joyko', 'price' => 18000, 'stock' => 3],
            ['name' => 'Spidol Boardmarker Hitam', 'price' => 8500, 'stock' => 35],
            ['name' => 'Spidol Boardmarker Merah', 'price' => 8500, 'stock' => 13],
            ['name' => 'Stabilo Boss Kuning', 'price' => 12000, 'stock' => 15],
            ['name' => 'Sticky Notes / Post-it 3x3', 'price' => 6000, 'stock' => 45],
            ['name' => 'Tinta Printer Epson 003 Black', 'price' => 85000, 'stock' => 5],
            ['name' => 'Tinta Spidol Snowman Hitam', 'price' => 15000, 'stock' => 12],
            ['name' => 'Tipex Cair Joyko', 'price' => 6500, 'stock' => 30],
        ];

        foreach ($products as $item) {
            Product::create($item);
        }
    }
}