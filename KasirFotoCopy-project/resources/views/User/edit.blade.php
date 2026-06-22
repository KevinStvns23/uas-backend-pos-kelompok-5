<h1>Edit User: {{ $user->nama_lengkap }}</h1>

<form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Username:</label>
    <input type="text" name="username" value="{{ $user->username }}" required><br><br>

    <label>Password (Kosongkan jika tidak ubah):</label>
    <input type="password" name="password"><br><br>

    <label>Nama Lengkap:</label>
    <input type="text" name="nama_lengkap" value="{{ $user->nama_lengkap }}" required><br><br>

    <label>Alamat:</label>
    <textarea name="alamat">{{ $user->alamat }}</textarea><br><br>

    <label>No Telp:</label>
    <input type="number" name="no_telp" value="{{ $user->no_telp }}"><br><br>

    <label>Shift:</label>
    <select name="shift">
        <option value="Shift 1" {{ $user->shift == 'Shift 1' ? 'selected' : '' }}>Shift 1</option>
        <option value="Shift 2" {{ $user->shift == 'Shift 2' ? 'selected' : '' }}>Shift 2</option>
        <option value="Full" {{ $user->shift == 'Full' ? 'selected' : '' }}>Full</option>
    </select><br><br>

    <input type="hidden" name="role" value="{{ $user->role }}">
    <input type="hidden" name="status" value="{{ $user->status }}">

    <button type="submit">Simpan</button>
    <a href="/user">Batal</a>
</form>