<!DOCTYPE html>
<html>
<head>
    <title>Detail Kategori</title>
    <style>
        body { margin: 0; display: flex; font-family: Arial, sans-serif; }
        .sidebar { width: 200px; background: #f4f4f4; padding: 15px; height: 100vh; border-right: 1px solid #ccc; }
        .sidebar a { display: block; padding: 10px; margin-bottom: 5px; text-decoration: none; color: black; border: 1px solid #ccc; background: white; }
        .content { padding: 20px; flex: 1; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: left; }
        .btn-back { display: inline-block; padding: 10px 15px; background: #ccc; text-decoration: none; color: black; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Menu Kasir</h3>
        <a href="/categories" style="font-weight: bold; background: #e0e0e0;">Kategori</a>
        <a href="/sub-categories">Sub-Kategori</a>
        <a href="/catalog-discounts">Katalog Diskon</a>
    </div>

    <div class="content">
        <a href="{{ route('categories.index') }}" class="btn-back">Kembali ke Daftar Kategori</a>
        
        <h1>Kategori: {{ $category->name }}</h1>
        <p><strong>Deskripsi:</strong> {{ $category->description }}</p>

        <h2>Daftar Sub-Kategori</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Sub-Kategori</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($category->subCategories as $sub)
                <tr>
                    <td>{{ $sub->id }}</td>
                    <td>{{ $sub->name }}</td>
                    <td>{{ $sub->description }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center; font-style: italic;">Belum ada sub-kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>