<h1>Tambah Produk Baru</h1>
<form method="POST" action="{{ route('products.store') }}">
    @csrf
    <p>Nama Barang: <input type="text" name="name" required></p>
    <p>Harga (Rp): <input type="number" name="price" min="0" required></p>
    <p>Stok Awal: <input type="number" name="stock" min="0" required></p>
    <p>Promo Diskon: 
        <select name="discount_id">
            <option value="">-- Tidak Ada Promo --</option>
            @foreach($discounts as $discount)
                <option value="{{ $discount->id }}">{{ $discount->promo_name }} ({{ $discount->percentage }}%)</option>
            @endforeach
        </select>
    </p>
    <button type="submit">Simpan</button>
</form>
<br><a href="{{ route('products.index') }}">Kembali</a>