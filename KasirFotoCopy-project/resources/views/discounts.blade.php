<!DOCTYPE html>
<html>
<head>
    <title>Katalog Diskon</title>
    <style>
        body { margin: 0; display: flex; font-family: Arial, sans-serif; }
        .sidebar { width: 200px; background: #f4f4f4; padding: 15px; height: 100vh; border-right: 1px solid #ccc; }
        .sidebar a { display: block; padding: 10px; margin-bottom: 5px; text-decoration: none; color: black; border: 1px solid #ccc; background: white; }
        .content { padding: 20px; flex: 1; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Menu Kasir</h3>
        <a href="/categories">Kategori</a>
        <a href="/sub-categories">Sub-Kategori</a>
        <a href="/discounts" style="font-weight: bold; background: #e0e0e0;">Katalog Diskon</a>
    </div>

    <div class="content">
        <h1>Katalog Produk Diskon</h1>

        <table>
            <thead>
                <tr>
                    <th>Ruang Promo</th>
                    <th>Nama Produk</th>
                    <th>Harga Normal</th>
                    <th>Diskon (%)</th>
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
                                <td colspan="5" style="text-align: center; font-style: italic; color: #777;">Belum ada produk di ruang promo ini</td>
                            </tr>
                        @endif
                    @endif
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; font-style: italic; color: #777;">Katalog promo kosong. Belum ada program diskon yang tersedia saat ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>