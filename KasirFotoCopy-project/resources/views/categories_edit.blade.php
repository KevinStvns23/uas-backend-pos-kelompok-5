<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
    <style>
        body { margin: 0; display: flex; font-family: Arial, sans-serif; }
        .sidebar { width: 200px; background: #f4f4f4; padding: 15px; height: 100vh; border-right: 1px solid #ccc; }
        .sidebar a { display: block; padding: 10px; margin-bottom: 5px; text-decoration: none; color: black; border: 1px solid #ccc; background: white; }
        .content { padding: 20px; flex: 1; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Menu Kasir</h3>
        <a href="/categories" style="font-weight: bold; background: #e0e0e0;">Kategori</a>
        <a href="/sub-categories">Sub-Kategori</a>
        <a href="/discounts">Diskon</a>
    </div>

    <div class="content">
        <h1>Edit Kategori</h1>

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
        
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            Nama Kategori:
            <br>
            <input type="text" name="name" value="{{ $category->name }}" required>
            <br><br>
            
            Deskripsi:
            <br>
            <textarea name="description" rows="3">{{ $category->description }}</textarea>
            <br><br>
            
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>