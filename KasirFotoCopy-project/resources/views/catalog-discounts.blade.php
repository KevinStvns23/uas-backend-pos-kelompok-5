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

        @if(session('success'))
            <div><b>Berhasil:</b> {{ session('success') }}</div>
            <br>
        @endif

        @if ($errors->any())
            <div>
                <b>Terjadi kesalahan pada input:</b>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br>
        @endif

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
                @forelse($discounts as $discount)
                    @if($discount->is_active)
                        @if($discount->products->count() > 0)
                            @foreach($discount->products as $product)
                            <tr>
                                <td>{{ $discount->promo_name }}</td>
                                <td>{{ $product->name }}</td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ $discount->percentage }}%</td>
                                <td>Rp {{ number_format($product->price - ($product->price * $discount->percentage / 100), 0, ',', '.') }}</td>
                                <td>{{ $product->stock }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>{{ $discount->promo_name }}</td>
                                <td colspan="5">Tidak terdapat produk pada promo ini.</td>
                            </tr>
                        @endif
                    @endif
                @empty
                    <tr>
                        <td colspan="6">Katalog promo kosong. Tidak terdapat program diskon yang tersedia saat ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>