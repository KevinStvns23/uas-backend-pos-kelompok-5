<!DOCTYPE html>
<html>
<head>
    <title>Detail Sub-Kategori</title>
    <style>
        body { margin: 0; display: flex; font-family: Arial, sans-serif; }
        .sidebar { width: 200px; background: #f4f4f4; padding: 15px; height: 100vh; border-right: 1px solid #ccc; }
        .sidebar a { display: block; padding: 10px; margin-bottom: 5px; text-decoration: none; color: black; border: 1px solid #ccc; background: white; }
        .content { padding: 20px; flex: 1; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: left; }
        .btn-back { display: inline-block; padding: 10px 15px; background: #ccc; text-decoration: none; color: black; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Menu Kasir</h3>
        <a href="/categories">Kategori</a>
        <a href="/sub-categories" style="font-weight: bold; background: #e0e0e0;">Sub-Kategori</a>
        <a href="/catalog-discounts">Katalog Diskon</a>
    </div>

    <div class="content">
        <a href="{{ route('sub-categories.index') }}" class="btn-back">Kembali ke Daftar Sub-Kategori</a>
        
        <h1>Sub-Kategori: {{ $subCategory->name }}</h1>
        <p><strong>Deskripsi:</strong> {{ $subCategory->description }}</p>

        <h2>Daftar Produk</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @if(class_exists('App\Models\Product'))
                    @forelse($subCategory->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align: center; font-style: italic;">Belum ada produk dalam sub-kategori ini.</td>
                    </tr>
                    @endforelse
                @else
                    <tr>
                        <td colspan="3" style="text-align: center; font-style: italic;">Belum ada produk dalam sub-kategori ini.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>