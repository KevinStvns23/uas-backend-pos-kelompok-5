<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pendapatan | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light p-4">
    <div class="container bg-white p-4 rounded shadow-sm">
        
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="m-0 text-primary"><i class="bi bi-wallet2"></i> Laporan Pendapatan</h2>
            <div class="btn-group">
                <a href="/reports/income" class="btn btn-primary active"><i class="bi bi-graph-up-arrow"></i> Pendapatan</a>
                <a href="/reports/stock" class="btn btn-outline-primary"><i class="bi bi-box-seam"></i> Stok Kritis</a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card bg-success text-white shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-cash-stack display-4 me-3"></i>
                        <div>
                            <h6 class="card-title mb-1">Total Akumulasi Pendapatan</h6>
                            <h3 class="m-0">Rp. {{ number_format($incomes->sum('total_pendapatan'), 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-info text-white shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-receipt display-4 me-3"></i>
                        <div>
                            <h6 class="card-title mb-1">Total Keseluruhan Transaksi</h6>
                            <h3 class="m-0">{{ $incomes->sum('total_transaksi') }} Transaksi</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal Rekap</th>
                        <th>Jumlah Transaksi</th>
                        <th>Pendapatan Kasir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($incomes as $index => $income)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center fw-bold">{{ \Carbon\Carbon::parse($income->tanggal_laporan)->translatedFormat('d F Y') }}</td>
                        <td class="text-center"><span class="badge bg-secondary px-3 py-2">{{ $income->total_transaksi }}</span></td>
                        <td class="text-end text-success fw-bold">Rp. {{ number_format($income->total_pendapatan, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Belum ada data pendapatan tercatat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="text-end text-muted small mt-2">
            <em>*Data digenerate secara real-time dari sistem POS</em>
        </div>

    </div>
</body>
</html>