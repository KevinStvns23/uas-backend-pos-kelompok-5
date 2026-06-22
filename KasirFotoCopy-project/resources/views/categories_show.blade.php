<!DOCTYPE html>
<html>
<head>
    <title>Detail Kategori</title>
</head>
<body>
    <nav>
        <h3>Menu Utama</h3>
        <ul>
            <li><b>Kategori</b></li>
            <li><a href="/sub-categories">Sub-Kategori</a></li>
            <li><a href="/catalog-discounts">Katalog Diskon</a></li>
        </ul>
    </nav>
    <hr>

    <div>
        <a href="{{ route('categories.index') }}">[Kembali ke Daftar Kategori]</a>
        
        <h1>Kategori: {{ $category->name }}</h1>
        <p><strong>Deskripsi:</strong> {{ $category->description }}</p>

        <h2>Daftar Sub-Kategori</h2>
        <table border="1" cellpadding="5" cellspacing="0">
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
                    <td colspan="3">Tidak ada sub-kategori yang tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>