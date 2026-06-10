<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IncomeReport;
use App\Models\StockReport;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        // Suntik 2 Data Pendapatan
        IncomeReport::create([
            'tanggal_laporan' => '2026-06-01',
            'total_transaksi' => 45,
            'total_pendapatan' => 1250000
        ]);
        IncomeReport::create([
            'tanggal_laporan' => '2026-06-02',
            'total_transaksi' => 60,
            'total_pendapatan' => 1800000
        ]);

        // Suntik 2 Data Stok
        StockReport::create([
            'nama_barang' => 'Kertas A4 Sidu',
            'sisa_stok' => 2,
            'status_peringatan' => 'Stok Menipis'
        ]);
        StockReport::create([
            'nama_barang' => 'Tinta Printer Epson Hitam',
            'sisa_stok' => 0,
            'status_peringatan' => 'Habis'
        ]);
    }
}