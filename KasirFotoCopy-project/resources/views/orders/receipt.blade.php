<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
</head>
<body>

<h1>Struk Belanja</h1>

<hr>

<table border="1" cellpadding="10">

    <tr>
        <th>Nama Product</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>Subtotal</th>
    </tr>

    @foreach(session('cart') as $item)

    <tr>
        <td>{{ $item['name'] }}</td>
        <td>Rp {{ $item['price'] }}</td>
        <td>{{ $item['quantity'] }}</td>
        <td>Rp {{ $item['subtotal'] }}</td>
    </tr>

    @endforeach

</table>

<br>

<h3>Total Harga: Rp {{ session('checkout.total') }}</h3>

@if(session('checkout.discount') > 0)

    <h3>Diskon: Rp {{ session('checkout.discount') }}</h3>

@endif

<h2>Total Akhir: Rp {{ session('checkout.final_total') }}</h2>

<hr>

<h3>Metode Pembayaran:</h3>
<p>{{ session('checkout.payment_method') }}</p>

<h3>Kode Promo:</h3>
<p>{{ session('checkout.promo_code') }}</p>

<h3>Tanggal Transaksi:</h3>
<p>{{ session('checkout.date') }}</p>

<form action="/orders/reset" method="POST">

    @csrf

    <button type="submit">
        Selesai Transaksi
    </button>

</form>

</body>
</html>