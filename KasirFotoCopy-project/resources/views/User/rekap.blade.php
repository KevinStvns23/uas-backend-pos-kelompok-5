<h1>Rekap Absensi</h1>
<a href="/user">< Kembali</a>

<h3>Bulanan</h3>
<table border="1" style="width: 100%; text-align: center; margin-bottom: 30px;">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Hari Kerja</th>
            <th>Total Durasi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($absensi->groupBy('user_id') as $user_id => $data)
            @php
                $total_detik = 0;
                foreach($data as $a) {
                    if($a->jam_masuk && $a->jam_keluar) {
                        $in = \Carbon\Carbon::parse($a->jam_masuk);
                        $out = \Carbon\Carbon::parse($a->jam_keluar);
                        // abs() memastikan hasilnya selalu positif (nggak minus)
                        $total_detik += abs($out->diffInSeconds($in));
                    }
                }
                
                // Konversi ke hari, jam, menit
                $hari = floor($total_detik / 86400);
                $sisa_detik = $total_detik % 86400;
                $jam = floor($sisa_detik / 3600);
                $menit = floor(($sisa_detik % 3600) / 60);
                
                // Format Tampilan Dinamis
                $durasi = "";
                if($hari > 0) $durasi .= $hari . " Hari ";
                if($jam > 0) $durasi .= $jam . " Jam ";
                $durasi .= $menit . " Menit";
            @endphp
            <tr>
                <td>{{ optional($data->first()->user)->nama_lengkap ?? 'User Dihapus' }}</td>
                <td>{{ $data->count() }} Hari</td>
                <td>{{ $durasi }}</td>
            </tr>
        @empty
            <tr><td colspan="3">Belum ada data.</td></tr>
        @endforelse
    </tbody>
</table>

<h3>Harian</h3>
<table border="1" style="width: 100%; text-align: center;">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Shift</th>
        </tr>
    </thead>
    <tbody>
        @forelse($absensi as $item)
            @php
                $jam_masuk = strtotime($item->jam_masuk);
                $shift = ($jam_masuk >= strtotime('07:00') && $jam_masuk <= strtotime('11:00')) ? "Shift 1" : "Shift 2";
            @endphp
            <tr>
                <td>{{ $item->tanggal }}</td>
                <td>{{ optional($item->user)->nama_lengkap ?? 'User Dihapus' }}</td>
                <td>{{ $item->jam_masuk }}</td>
                <td>{{ $item->jam_keluar ?? 'Belum' }}</td>
                <td>{{ $shift }}</td>
            </tr>
        @empty
            <tr><td colspan="5">Belum ada data.</td></tr>
        @endforelse
    </tbody>
</table>