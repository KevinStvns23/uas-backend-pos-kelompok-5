<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>

    <h1>Checkout</h1>

    @php

        $cart = session('cart', []);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['subtotal'];
        }

    @endphp

    <h2>Rincian Belanja</h2>

    <table border="1" cellpadding="10">

        <tr>
            <th>Nama Product</th>
            <th>Harga</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>

        @foreach($cart as $item)

        <tr>
            <td>{{ $item['name'] }}</td>
            <td>Rp {{ $item['price'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>Rp {{ $item['subtotal'] }}</td>
        </tr>

        @endforeach

    </table>

    <br>

    @php

        $discount = 0;

        if(session('promo_code') == 'DISKON10') {
            $discount = $total * 0.1;
        }

        $finalTotal = $total - $discount;

    @endphp

    <h3>Total Harga: Rp {{ $total }}</h3>

    @if(session('promo_code') == 'DISKON10')

        <h3>Diskon: 10%</h3>

        <h3>Potongan Harga: Rp {{ $discount }}</h3>

        <h2>Total Setelah Diskon: Rp {{ $finalTotal }}</h2>

    @endif

    <hr>

    <h2>Pembayaran</h2>

    <div>
        <form action="/orders/apply-promo" method="POST">

            @csrf

            <label>Kode Promo</label>

            <input type="text" name="promo_code">

            <button type="submit">
                Apply Promo
            </button>

        </form>
    </div>

    <br>

    <form action="/orders/checkout" method="POST">

        @csrf

        <div>
            <label>Metode Pembayaran</label>

            <select name="payment_method">
                <option value="Cash">Cash</option>
                <option value="QRIS">QRIS</option>
                <option value="Debit">Debit</option>
            </select>
        </div>

        <br>

        <button type="submit">
            Proses Checkout
        </button>

    </form>


</body>
</html>