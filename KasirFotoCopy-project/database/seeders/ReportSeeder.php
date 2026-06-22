<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IncomeReport;
use App\Models\StockReport;
use Carbon\Carbon;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $incomes = [
            ['tanggal_laporan' => '2026-06-01', 'total_transaksi' => 45, 'total_pendapatan' => 1250000],
            ['tanggal_laporan' => '2026-06-02', 'total_transaksi' => 60, 'total_pendapatan' => 1800000],
            ['tanggal_laporan' => '2026-06-03', 'total_transaksi' => 35, 'total_pendapatan' => 950000],
            ['tanggal_laporan' => '2026-06-04', 'total_transaksi' => 80, 'total_pendapatan' => 2400000],
            ['tanggal_laporan' => '2026-06-05', 'total_transaksi' => 55, 'total_pendapatan' => 1650000],
        ];
        foreach ($incomes as $income) {
            IncomeReport::create($income);
        }

        $stocks = [
            ['nama_barang' => 'Kertas A4 Sidu 80gsm', 'sisa_stok' => 2, 'status_peringatan' => 'Stok Menipis'],
            ['nama_barang' => 'Tinta Printer Epson Hitam', 'sisa_stok' => 0, 'status_peringatan' => 'Habis'],
            ['nama_barang' => 'Pulpen Faster Hitam (Pak)', 'sisa_stok' => 1, 'status_peringatan' => 'Stok Menipis'],
            ['nama_barang' => 'Spidol Boardmarker Snowman', 'sisa_stok' => 0, 'status_peringatan' => 'Habis'],
            ['nama_barang' => 'Isi Staples Kenko Kecil', 'sisa_stok' => 3, 'status_peringatan' => 'Stok Menipis'],
            ['nama_barang' => 'Map Plastik Bening', 'sisa_stok' => 0, 'status_peringatan' => 'Habis'],
        ];
        foreach ($stocks as $stock) {
            StockReport::create($stock);
        }
    }
}