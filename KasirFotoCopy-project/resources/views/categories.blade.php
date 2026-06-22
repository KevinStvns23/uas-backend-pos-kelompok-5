<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Kategori</title>
</head>
<body>
    @include('navbar')
    <div>
        <h1>Manajemen Kategori</h1>

        @if(session('success'))
            <div><b>Berhasil:</b> {{ session('success') }}</div>
            <br>
        @endif

        @if ($errors->any())
            <div>
                <b>Terjadi kesalahan pada input:</b>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br>
        @endif

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            Nama Kategori:
            <br>
            <input type="text" name="name" required>
            <br><br>
            
            Deskripsi:
            <br>
            <textarea name="description" rows="3"></textarea>
            <br><br>
            
            <button type="submit">Simpan</button>
        </form>

        <h2>Daftar Kategori</h2>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('categories.show', $category->id) }}">[Lihat Sub-Kategori]</a>
                        <a href="{{ route('categories.edit', $category->id) }}">[Ubah]</a>
                        
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>