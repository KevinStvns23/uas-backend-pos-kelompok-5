<!DOCTYPE html>
<html>
<head><title>Laporan Stok Barang</title></head>
<body>
    <h1>Laporan Barang Kritis / Habis</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Sisa Stok</th>
            <th>Status Peringatan</th>
        </tr>
        @foreach($stocks as $stock)
        <tr>
            <td>{{ $stock->id }}</td>
            <td>{{ $stock->nama_barang }}</td>
            <td>{{ $stock->sisa_stok }}</td>
            <td>{{ $stock->status_peringatan }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>