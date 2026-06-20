@if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px;">
        {{ session('error') }}
    </div>
@endif

<h1>Daftar User</h1>

@if(Auth::user()->role == 'Owner')
    <a href="{{ route('absensi.rekap') }}">[ Lihat Rekapan Absensi ]</a>
    <br><br>
@endif

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

<br>

<style>
    .grid-container {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        margin-top: 10px;
    }
    .user-card {
        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        background-color: #f9f9f9;
    }
    .user-card img {
        border-radius: 50%;
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin-bottom: 10px;
    }
    .action-group {
        margin-top: 15px;
        font-size: 14px;
    }
    .action-group form {
        display: inline;
    }
</style>

<div class="grid-container">
    @foreach($user as $item)
    <div class="user-card">
        
        @if($item->foto)
            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto">
        @else
            <img src="{{ asset('images/default.png') }}" alt="Foto">
        @endif

        <h3 style="margin: 5px 0;">{{ $item->nama_lengkap }}</h3>
        <p style="margin: 0; color: gray;">{{ $item->username }}</p>
        <p style="margin: 5px 0;"><strong>Shift:</strong> {{ $item->shift }}</p>

        <div style="margin-bottom: 10px;">
            @if(Auth::user()->role == 'Owner')
                <form action="{{ route('user.updateStatus', $item->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" onchange="this.form.submit()" style="padding: 3px;">
                        <option value="Aktif" {{ $item->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Nonaktif" {{ $item->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </form>
            @else
                <span style="background: #ddd; padding: 2px 8px; border-radius: 4px;">{{ $item->status }}</span>
            @endif
        </div>

        <div style="margin-bottom: 10px;">
            @if(Auth::id() == $item->id)
                <form action="{{ route('absensi.checkin') }}" method="POST" style="display:inline;">
                    @csrf <button type="submit" style="background: #28a745; color: white; border: none; padding: 5px 10px; cursor: pointer;">Check In</button>
                </form>
                <form action="{{ route('absensi.checkout') }}" method="POST" style="display:inline;">
                    @csrf <button type="submit" style="background: #dc3545; color: white; border: none; padding: 5px 10px; cursor: pointer;">Check Out</button>
                </form>
            @endif
        </div>

        <hr style="border: 0.5px solid #ddd; margin: 10px 0;">

        <div class="action-group">
            <a href="/user/{{ $item->id }}/edit" style="text-decoration: none; color: blue;">[ Edit ]</a> 
            
            @if(Auth::user()->role != 'Kasir')
                &nbsp;|&nbsp; 
                <a href="{{ route('user.cetak-data', $item->id) }}" target="_blank" style="text-decoration: none; color: green;">[ Cetak ]</a>
                <br><br>
                <form action="{{ route('user.reset-password', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" onclick="return confirm('Reset password ke 12345?')">Reset Pass</button>
                </form>
            @endif

            @if(Auth::user()->role == 'Owner' || (Auth::user()->role == 'Admin' && $item->role == 'Kasir'))
                <br>
                <form action="/user/{{ $item->id }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm ('Apakah anda yakin mau menghapus data ini?')" style="margin-top: 5px; color: red;">Hapus Data</button>
                </form>
            @endif
        </div>

    </div>
    @endforeach
</div>