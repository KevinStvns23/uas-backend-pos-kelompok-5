<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container bg-white p-4 rounded shadow">
        <h2 class="mb-4">📦 Laporan Barang Kritis / Habis</h2>

        <div class="mb-3">
            <a href="/reports/income" class="btn btn-outline-secondary">Laporan Pendapatan</a>
            <a href="/reports/stock" class="btn btn-primary">Laporan Stok</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Sisa Stok</th>
                    <th>Status Peringatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                <tr>
                    <td>{{ $stock->id }}</td>
                    <td>{{ $stock->nama_barang }}</td>
                    <td class="fw-bold">{{ $stock->sisa_stok }} Unit</td>
                    <td>
                        @if($stock->status_peringatan == 'Habis')
                            <span class="badge bg-danger">{{ $stock->status_peringatan }}</span>
                        @else
                            <span class="badge bg-warning text-dark">{{ $stock->status_peringatan }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>