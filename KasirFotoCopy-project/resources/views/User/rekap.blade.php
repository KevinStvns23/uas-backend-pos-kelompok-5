<h1>Rekap Absensi Pegawai - Bulan {{ date('F Y') }}</h1>
<a href="/user">< Kembali ke Daftar User</a>
<br><br>

<h3>Total Kerja Bulanan</h3>
<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; text-align: center; margin-bottom: 30px;">
    <thead style="background-color: #f2f2f2;">
        <tr>
            <th>Nama Pegawai</th>
            <th>Total Hari Kerja</th>
            <th>Total Jam Kerja</th>
        </tr>
    </thead>
    <tbody>
        @php
            $rekap_bulanan = $absensi->groupBy('user_id');
        @endphp

        @foreach($rekap_bulanan as $user_id => $data)
        @php
            $total_hari = $data->count();
            $total_jam = 0;
            
            foreach($data as $absen) {
                if($absen->jam_masuk && $absen->jam_keluar) {
                    $in = \Carbon\Carbon::parse($absen->tanggal . ' ' . $absen->jam_masuk);
                    $out = \Carbon\Carbon::parse($absen->tanggal . ' ' . $absen->jam_keluar);
                    $total_jam += $out->diffInHours($in);
                }
            }
        @endphp
        <tr>
            <td style="text-align: left;">{{ $data->first()->user->nama_lengkap ?? 'User Dihapus' }}</td>
            <td>{{ $total_hari }} Hari</td>
            <td>{{ $total_jam }} Jam</td>
        </tr>
        @endforeach

        @if($absensi->isEmpty())
        <tr>
            <td colspan="3">Data absensi di bulan ini masih belum ada.</td>
        </tr>
        @endif
    </tbody>
</table>

<hr style="border: 0.5px solid #ccc; margin-bottom: 20px;">

<h3>Detail Absensi Harian</h3>
<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; text-align: center;">
    <thead style="background-color: #f2f2f2;">
        <tr>
            <th>Tanggal</th>
            <th>Nama Pegawai</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>Shift</th>
        </tr>
    </thead>
    <tbody>
        @foreach($absensi as $item)
        @php
            $jam = strtotime($item->jam_masuk);
            $shift = "-";
            if ($jam >= strtotime('07:00') && $jam <= strtotime('11:00')) {
                $shift = "Shift 1";
            } elseif ($jam >= strtotime('12:30') && $jam <= strtotime('23:00')) {
                $shift = "Shift 2";
            }
        @endphp
        <tr>
            <td>{{ $item->tanggal }}</td>
            <td>{{ $item->user->nama_lengkap ?? 'User Dihapus' }}</td>
            <td>{{ $item->jam_masuk }}</td>
            <td>{{ $item->jam_keluar ?? 'Belum Keluar' }}</td>
            <td>{{ $shift }}</td>
        </tr>
        @endforeach

        @if($absensi->isEmpty())
        <tr>
            <td colspan="5">Data absensi di bulan ini masih belum ada.</td>
        </tr>
        @endif
    </tbody>
</table>