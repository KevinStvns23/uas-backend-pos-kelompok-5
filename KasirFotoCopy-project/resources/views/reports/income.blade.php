<!DOCTYPE html>
<html>
<head><title>Laporan Pendapatan</title></head>
<body>
    <h1>Laporan Pendapatan Tutup Kasir</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Tanggal Laporan</th>
            <th>Total Transaksi</th>
            <th>Total Pendapatan</th>
        </tr>
        @foreach($incomes as $income)
        <tr>
            <td>{{ $income->id }}</td>
            <td>{{ $income->tanggal_laporan }}</td>
            <td>{{ $income->total_transaksi }}</td>
            <td>Rp. {{ number_format($income->total_pendapatan) }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>