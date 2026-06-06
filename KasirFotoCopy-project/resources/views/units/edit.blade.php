<h1>Ubah Data Satuan</h1>

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

<form method="POST" action="{{ route('units.update', $unit) }}">
    @csrf @method('PUT')
    <p>ID Satuan: UNT-{{ sprintf('%03d', $unit->id) }}</p>
    <p>Nama Satuan: <input type="text" name="name" value="{{ $unit->name }}" required></p>
    <p>Keterangan: <input type="text" name="description" value="{{ $unit->description }}"></p>
    <button type="submit">Update</button>
</form>
<br><a href="{{ route('units.index') }}">Kembali</a>
