<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Sub-Kategori</title>
    <style>
        body { margin: 0; display: flex; font-family: Arial, sans-serif; }
        .sidebar { width: 200px; background: #f4f4f4; padding: 15px; height: 100vh; border-right: 1px solid #ccc; }
        .sidebar a { display: block; padding: 10px; margin-bottom: 5px; text-decoration: none; color: black; border: 1px solid #ccc; background: white; }
        .content { padding: 20px; flex: 1; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Menu Kasir</h3>
        <a href="/categories">Kategori</a>
        <a href="/sub-categories" style="font-weight: bold; background: #e0e0e0;">Sub-Kategori</a>
        <a href="/catalog-discounts">Katalog Diskon</a>
    </div>

    <div class="content">
        <h1>Manajemen Sub-Kategori</h1>

        @if(session('success'))
            <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px; background: #ffeeee;">
                <strong>Ups! Ada kesalahan:</strong>
                <ul style="margin: 5px 0 0 15px; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
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
        <table>
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
                        <a href="{{ route('sub-categories.show', $subCategory->id) }}" style="text-decoration: none; padding: 2px 8px; border: 1px solid green; color: green; margin-right: 5px;">Lihat Produk</a>
                        <a href="{{ route('sub-categories.edit', $subCategory->id) }}" style="text-decoration: none; padding: 2px 8px; border: 1px solid blue; color: blue; margin-right: 5px;">Edit</a>
                        
                        <form action="{{ route('sub-categories.destroy', $subCategory->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus sub-kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>