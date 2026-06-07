<h1>Sistem Kasir ATK - Manajemen Produk</h1>
<a href="{{ route('products.create') }}">Tambah Produk Baru</a> | 
<a href="{{ route('discounts.index') }}">Kelola Diskon</a> | 
<a href="{{ route('units.index') }}">Kelola Satuan</a>
<br><br>

<form method="GET" action="{{ route('products.index') }}" style="margin-bottom: 15px;">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang..." required>
    <button type="submit">Cari</button>
    <a href="{{ route('products.index') }}"><button type="button">Reset</button></a>
</form>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Harga Jual</th>
            <th>Promo Diskon</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>PRD-{{ sprintf('%03d', $product->id) }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->unit ? $product->unit->name : 'Belum Diatur' }}</td>
            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td>
                @if($product->discount)
                    {{ $product->discount->promo_name }} (-{{ $product->discount->percentage }}%)
                @else
                    -
                @endif
            </td>
            <td>
                @if($product->stock < 5)
                    {{ $product->stock }} (Sisa Dikit!)
                @else
                    {{ $product->stock }}
                @endif
            </td>
            <td>
                <a href="{{ route('products.edit', $product) }}">Ubah</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus barang ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="text-align: center;">Tidak ada barang yang ditemukan.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 15px;">
    {{ $products->appends(['search' => request('search')])->links() }}
</div>