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

        if(session('promo_percentage')) {
            $discount =
                $total * session('promo_percentage') / 100;
        }

        $finalTotal = $total - $discount;

    @endphp

    <h3>Total Harga: Rp {{ $total }}</h3>

    @if(session('promo_name'))

        <h3>
            Promo:
            {{ session('promo_name') }}
            ({{ session('promo_percentage') }}%)
        </h3>

        <h3>
            Potongan Harga:
            Rp {{ $discount }}
        </h3>

        <h2>
            Total Setelah Diskon:
            Rp {{ $finalTotal }}
        </h2>

    @endif

    <hr>

    <h2>Pembayaran</h2>

    <div>
        <label>Pilih Promo</label>

        <form action="/orders/apply-promo" method="POST">
            @csrf

            <select name="promo_code">
                <option value="">-- Pilih Promo --</option>

                @foreach($discounts as $discount)
                    <option value="{{ $discount->promo_name }}">
                        {{ $discount->promo_name }}
                        ({{ $discount->percentage }}%)
                    </option>
                @endforeach

            </select>

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