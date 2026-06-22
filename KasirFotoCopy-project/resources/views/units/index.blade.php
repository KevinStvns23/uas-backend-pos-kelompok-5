<h1>Manajemen Satuan Barang</h1>
<a href="{{ route('units.create') }}">Tambah Satuan</a> | 
<a href="{{ route('products.index') }}">Ke Produk</a>
<br><br>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Satuan</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($units as $unit)
        <tr>
            <td>UNT-{{ sprintf('%03d', $unit->id) }}</td>
            <td>{{ $unit->name }}</td>
            <td>{{ $unit->description }}</td>
            <td>
                <a href="{{ route('units.edit', $unit) }}">Ubah</a>
                <form action="{{ route('units.destroy', $unit) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus satuan ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>