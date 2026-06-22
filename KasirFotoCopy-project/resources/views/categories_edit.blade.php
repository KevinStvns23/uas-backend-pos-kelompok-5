<!DOCTYPE html>
<html>
<head>
    <title>Ubah Kategori</title>
</head>
<body>
    @include('navbar')
    <div>
        <h1>Ubah Kategori</h1>

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
            
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>