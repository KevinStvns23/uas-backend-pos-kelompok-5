<h1>Tambah Satuan Baru</h1>
<form method="POST" action="{{ route('units.store') }}">
    @csrf
    <p>Nama Satuan: <input type="text" name="name" required></p>
    <p>Keterangan: <input type="text" name="description"></p>
    <button type="submit">Simpan</button>
</form>
<br><a href="{{ route('units.index') }}">Kembali</a>