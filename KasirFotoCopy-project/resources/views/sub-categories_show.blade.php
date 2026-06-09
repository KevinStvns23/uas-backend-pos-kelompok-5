<!DOCTYPE html>
<html>
<head>
    <title>Detail Sub-Kategori</title>
</head>
<body>
    <nav>
        <h3>Menu Utama</h3>
        <ul>
            <li><a href="/categories">Kategori</a></li>
            <li><b>Sub-Kategori</b></li>
            <li><a href="/catalog-discounts">Katalog Diskon</a></li>
        </ul>
    </nav>
    <hr>

    <div>
        <a href="{{ route('sub-categories.index') }}">[Kembali ke Daftar Sub-Kategori]</a>
        
        <h1>Sub-Kategori: {{ $subCategory->name }}</h1>
        <p><strong>Deskripsi:</strong> {{ $subCategory->description }}</p>

        <h2>Daftar Produk</h2>
        <table border="1" cellpadding="5" cellspacing="0">
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
                        <td colspan="3">Tidak ada produk yang tersedia dalam sub-kategori ini.</td>
                    </tr>
                    @endforelse
                @else
                    <tr>
                        <td colspan="3">Tidak ada produk yang tersedia dalam sub-kategori ini.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>