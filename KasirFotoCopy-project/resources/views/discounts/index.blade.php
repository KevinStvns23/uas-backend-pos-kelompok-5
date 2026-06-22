@include('navbar')

<h1>Manajemen Promo Diskon</h1>
<a href="{{ route('discounts.create') }}">Tambah Promo</a> | 
<a href="{{ route('products.index') }}">Ke Produk</a>
<br><br>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Promo</th>
            <th>Diskon (%)</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($discounts as $discount)
        <tr>
            <td>DSC-{{ sprintf('%03d', $discount->id) }}</td>
            <td>{{ $discount->promo_name }}</td>
            <td>{{ $discount->percentage }}%</td>
            <td>
                @if($discount->is_active)
                    Aktif
                @else
                    Non-Aktif
                @endif
            </td>
            <td>
                <a href="{{ route('discounts.edit', $discount) }}">Ubah</a>
                <form action="{{ route('discounts.destroy', $discount) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus promo ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>