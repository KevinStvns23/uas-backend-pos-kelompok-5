<!DOCTYPE html>
<html>
<head>
    <title>Ubah Sub-Kategori</title>
</head>
<body>
    @include('navbar')
    <div>
        <h1>Ubah Sub-Kategori</h1>

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
            
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>