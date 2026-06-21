<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller {
    
    public function checkIn() {
        $sudahAbsenHariIni = Absensi::where('user_id', Auth::id())
                               ->where('tanggal', date('Y-m-d'))
                               ->first();
        
        if ($sudahAbsenHariIni) {
            return back()->with('error', 'Gagal: Anda telah mengambil shift hari ini!');
        }

        Absensi::create([
            'user_id' => Auth::id(),
            'tanggal' => date('Y-m-d'),
            'jam_masuk' => date('H:i:s'),
        ]);

        User::where('id', Auth::id())->update(['status' => 'Aktif']);
        return back()->with('success', 'Berhasil Check-in.');
    }

    public function checkOut() {
        $absensi = Absensi::where('user_id', Auth::id())
                          ->where('tanggal', date('Y-m-d'))
                          ->whereNull('jam_keluar')
                          ->first();

        if (!$absensi) {
            return back()->with('error', 'Belum Check-in atau sudah Check-out!');
        }

        $absensi->update(['jam_keluar' => date('H:i:s')]);
        User::where('id', Auth::id())->update(['status' => 'Nonaktif']);
        
        return back()->with('success', 'Berhasil Check-out.');
    }

    public function rekap() {
        $query = Absensi::with('user')
                          ->whereMonth('tanggal', date('m'))
                          ->whereYear('tanggal', date('Y'))
                          ->orderBy('tanggal', 'desc');

        if (Auth::user()->role == 'Kasir') {
            $query->where('user_id', Auth::id());
        }

        $absensi = $query->get();
        return view('user.rekap', compact('absensi'));
    }
}