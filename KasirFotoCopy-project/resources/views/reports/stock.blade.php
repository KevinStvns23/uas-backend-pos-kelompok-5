<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Stok | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light p-4">
    <div class="container bg-white p-4 rounded shadow-sm">
        
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="m-0 text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Peringatan Stok</h2>
            <div class="btn-group">
                <a href="/reports/income" class="btn btn-outline-primary"><i class="bi bi-graph-up-arrow"></i> Pendapatan</a>
                <a href="/reports/stock" class="btn btn-primary active"><i class="bi bi-box-seam"></i> Stok Kritis</a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-danger bg-opacity-10 border-danger border-start border-5 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-danger mb-0">
                            <i class="bi bi-bell-fill"></i> Terdapat <strong>{{ $stocks->where('status_peringatan', 'Habis')->count() }}</strong> barang yang kehabisan stok dan perlu segera di-restock!
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Barang Tulis / Fotocopy</th>
                        <th width="15%">Sisa Fisik</th>
                        <th width="20%">Status Indikator</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stocks as $index => $stock)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="fw-semibold">{{ $stock->nama_barang }}</td>
                        <td class="text-center">
                            <span class="fs-5">{{ $stock->sisa_stok }}</span> Unit
                        </td>
                        <td class="text-center">
                            @if($stock->status_peringatan == 'Habis')
                                <span class="badge bg-danger rounded-pill px-3 py-2"><i class="bi bi-x-circle me-1"></i> Habis Total</span>
                            @else
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2"><i class="bi bi-exclamation-circle me-1"></i> Stok Menipis</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Semua stok barang dalam kondisi aman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>
</body>
</html>