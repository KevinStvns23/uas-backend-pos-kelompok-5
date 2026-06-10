<!DOCTYPE html>
<html>
<head>
    <title>Katalog Diskon</title>
</head>
<body>
    <nav>
        <h3>Menu Utama</h3>
        <ul>
            <li><a href="/categories">Kategori</a></li>
            <li><a href="/sub-categories">Sub-Kategori</a></li>
            <li><b>Katalog Diskon</b></li>
        </ul>
    </nav>
    <hr>

    <div>
        <h1>Katalog Produk Diskon</h1>

        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Ruang Promo</th>
                    <th>Produk</th>
                    <th>Harga Asli</th>
                    <th>Persentase Diskon</th>
                    <th>Harga Akhir</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse($discountedProducts as $product)
                    <tr>
                        <td>{{ $product->discount->promo_name }}</td>
                        <td>{{ $product->name }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->discount->percentage }}%</td>
                        <td>Rp {{ number_format($product->price - ($product->price * $product->discount->percentage / 100), 0, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">Katalog promo kosong. Tidak terdapat program diskon yang tersedia saat ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>