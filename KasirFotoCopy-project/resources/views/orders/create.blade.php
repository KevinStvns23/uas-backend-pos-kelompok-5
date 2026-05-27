<!DOCTYPE html>
<html>
<head>
    <title>Kasir Order</title>
</head>
<body>

    <h1>Kasir Order</h1>

    <form action="/orders/add" method="POST">
        @csrf
        <div>
            <label>ID Product</label>
            <input type="text" name="product_id" required>
        </div>

        <br>

        <div>
            <label>Quantity</label>
            <input type="number" name="quantity" required>
        </div>

        <br>

        <button type="submit">
            Tambah Product
        </button>
    </form>

    <h2>Cart</h2>

    <table border="1" cellpadding="10">

        <tr>
            <th>Product ID</th>
            <th>Nama Product</th>
            <th>Harga</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Hapus</th>
        </tr>

        @php
            $total = 0;
        @endphp

        @if(session('cart'))

            @foreach(session('cart') as $item)

                @php
                    $total += $item['subtotal'];
                @endphp

                <tr>
                    <td>{{ $item['product_id'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>Rp {{ $item['price'] }}</td>
                    <td>
                        <form action="/orders/update/{{ $loop->index }}" method="POST">
                            @csrf
                            <input
                                type="number"
                                name="quantity"
                                value="{{ $item['quantity'] }}"
                                min="1"
                            >
                            <button type="submit">
                                Update
                            </button>
                        </form>
                    </td>
                    <td>Rp {{ $item['subtotal'] }}</td>
                    <td>
                        <form action="/orders/delete/{{ $loop->index }}" method="POST">
                            @csrf

                            <button type="submit">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>

            @endforeach

        @endif

    </table>

    <h3>Total Harga: Rp {{ $total }}</h3>

    <br>

    <a href="/orders/checkout">
        <button>
            Checkout
        </button>
    </a>

</body>
</html>