<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pendapatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container bg-white p-4 rounded shadow">
        <h2 class="mb-4">📊 Laporan Pendapatan Tutup Kasir</h2>
        
        <div class="mb-3">
            <a href="/reports/income" class="btn btn-primary">Laporan Pendapatan</a>
            <a href="/reports/stock" class="btn btn-outline-secondary">Laporan Stok</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tanggal Laporan</th>
                    <th>Total Transaksi</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($incomes as $income)
                <tr>
                    <td>{{ $income->id }}</td>
                    <td>{{ $income->tanggal_laporan }}</td>
                    <td>{{ $income->total_transaksi }} Transaksi</td>
                    <td>Rp. {{ number_format($income->total_pendapatan, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>