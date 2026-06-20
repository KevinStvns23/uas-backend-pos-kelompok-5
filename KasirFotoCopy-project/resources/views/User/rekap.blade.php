<h1>Rekap Absensi Pegawai</h1>
<a href="/user">< Kembali ke Daftar User</a>
<br><br>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
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
    </tbody>
</table>