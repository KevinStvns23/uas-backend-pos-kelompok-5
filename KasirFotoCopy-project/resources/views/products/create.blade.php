<h1>Tambah Produk Baru</h1>

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

<form method="POST" action="{{ route('products.store') }}">
    @csrf
    <p>Nama Barang: <input type="text" name="name" required></p>
    
    <p>Satuan: 
        <select name="unit_id" required>
            <option value="">-- Pilih Satuan --</option>
            @foreach($units as $unit)
                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
            @endforeach
        </select>
    </p>

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