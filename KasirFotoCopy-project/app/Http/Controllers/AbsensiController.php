<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function checkIn()
    {
        $sudahCheckIn = Absensi::where('user_id', Auth::id())
                               ->where('tanggal', date('Y-m-d'))
                               ->first();

        if ($sudahCheckIn) {
            return back()->with('error', 'Hari ini sudah Check-in!');
        }

        Absensi::create([
            'user_id' => Auth::id(),
            'tanggal' => date('Y-m-d'),
            'jam_masuk' => date('H:i:s'),
        ]);

        return back()->with('success', 'Berhasil Check-in.');
    }

    public function checkOut()
    {
        $absensi = Absensi::where('user_id', Auth::id())
                          ->where('tanggal', date('Y-m-d'))
                          ->whereNull('jam_keluar')
                          ->first();

        if (!$absensi) {
            return back()->with('error', 'Belum Check-in atau sudah Check-out!');
        }

        $absensi->update(['jam_keluar' => date('H:i:s')]);

        return back()->with('success', 'Berhasil Check-out.');
    }

    public function rekap()
    {
        // Ambil data absensi bulan ini dan tahun ini saja, urutkan dari yang terbaru
        $absensi = Absensi::with('user')
                    ->whereMonth('tanggal', date('m'))
                    ->whereYear('tanggal', date('Y'))
                    ->orderBy('tanggal', 'desc')
                    ->get();

        return view('user.rekap', compact('absensi'));
    }
}