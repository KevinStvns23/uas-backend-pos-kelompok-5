<!DOCTYPE html>
<html>
<head>
    <title>Edit Sub-Kategori</title>
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
        <a href="/categories">Kategori</a>
        <a href="/sub-categories" style="font-weight: bold; background: #e0e0e0;">Sub-Kategori</a>
        <a href="/discounts">Diskon</a>
    </div>

    <div class="content">
        <h1>Edit Sub-Kategori</h1>
        
        <form action="{{ route('sub-categories.update', $subCategory->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            Kategori Induk:
            <br>
            <select name="category_id" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $subCategory->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <br><br>
            
            Nama Sub-Kategori:
            <br>
            <input type="text" name="name" value="{{ $subCategory->name }}" required>
            <br><br>
            
            Deskripsi:
            <br>
            <textarea name="description" rows="3">{{ $subCategory->description }}</textarea>
            <br><br>
            
            <button type="submit">Update Data</button>
            <a href="{{ route('sub-categories.index') }}" style="margin-left: 10px;">Batal</a>
        </form>
    </div>
</body>
</html>