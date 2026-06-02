<h1>Ubah Data Satuan</h1>
<form method="POST" action="{{ route('units.update', $unit) }}">
    @csrf @method('PUT')
    <p>Nama Satuan: <input type="text" name="name" value="{{ $unit->name }}" required></p>
    <p>Keterangan: <input type="text" name="description" value="{{ $unit->description }}"></p>
    <button type="submit">Update</button>
</form>
<br><a href="{{ route('units.index') }}">Kembali</a>