<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Sub-Kategori</title>
</head>
<body>
    <nav>
        <h3>Menu Utama</h3>
        <ul>
            <li><a href="/categories">Kategori</a></li>
            <li><b>Sub-Kategori</b></li>
            <li><a href="/catalog-discounts">Katalog Diskon</a></li>
        </ul>
    </nav>
    <hr>

    <div>
        <h1>Manajemen Sub-Kategori</h1>

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

        <form action="{{ route('sub-categories.store') }}" method="POST">
            @csrf
            Kategori Induk:
            <br>
            <select name="category_id" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            <br><br>
            
            Nama Sub-Kategori:
            <br>
            <input type="text" name="name" required>
            <br><br>
            
            Deskripsi:
            <br>
            <textarea name="description" rows="3"></textarea>
            <br><br>
            
            <button type="submit">Simpan</button>
        </form>

        <h2>Daftar Sub-Kategori</h2>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori Induk</th>
                    <th>Nama Sub-Kategori</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subCategories as $subCategory)
                <tr>
                    <td>{{ $subCategory->id }}</td>
                    <td>{{ $subCategory->category->name ?? 'Tidak Ada' }}</td>
                    <td>{{ $subCategory->name }}</td>
                    <td>{{ $subCategory->description }}</td>
                    <td>
                        <a href="{{ route('sub-categories.show', $subCategory->id) }}">[Lihat Produk]</a>
                        <a href="{{ route('sub-categories.edit', $subCategory->id) }}">[Ubah]</a>
                        
                        <form action="{{ route('sub-categories.destroy', $subCategory->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus sub-kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>