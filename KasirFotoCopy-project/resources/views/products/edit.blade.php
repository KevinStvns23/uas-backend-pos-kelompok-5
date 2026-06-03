<h1>Ubah Data Produk</h1>

@if ($errors->any())
    <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
        <strong>Oops! Ada masalah:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('products.update', $product) }}">
    @csrf @method('PUT')
    <p>ID Produk: PRD-{{ sprintf('%03d', $product->id) }}</p>
    <p>Nama Barang: <input type="text" name="name" value="{{ $product->name }}" required></p>
    <p>Harga (Rp): <input type="number" name="price" value="{{ $product->price }}" min="0" required></p>
    <p>Stok: <input type="number" name="stock" value="{{ $product->stock }}" min="0" required></p>
    <button type="submit">Update</button>
</form>
<br><a href="{{ route('products.index') }}">Kembali</a>