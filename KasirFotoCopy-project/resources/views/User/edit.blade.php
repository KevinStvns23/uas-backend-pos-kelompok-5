<h1>Edit Data User: {{ $user->nama_lengkap }}</h1>

<form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label>Foto Saat Ini:</label><br>
        @if($user->foto)
            <img src="{{ asset('storage/' . $user->foto) }}" width="100" style="border-radius: 5px;">
        @else
            <p>Belum ada foto</p>
        @endif
    </div>

    <label>Ganti Foto:</label>
    <input type="file" name="foto"><br><br>

    <label>Username:</label>
    <input type="text" name="username" value="{{ $user->username }}" required><br>

    <label>Nama Lengkap:</label>
    <input type="text" name="nama_lengkap" value="{{ $user->nama_lengkap }}" required><br>

    <label>Shift:</label>
    <select name="shift">
        <option value="Shift 1" {{ $user->shift == 'Shift 1' ? 'selected' : '' }}>Shift 1</option>
        <option value="Shift 2" {{ $user->shift == 'Shift 2' ? 'selected' : '' }}>Shift 2</option>
    </select><br>
    
    <br>
    <button type="submit">Simpan Perubahan</button>
    <a href="/user">Batal</a>
</form>