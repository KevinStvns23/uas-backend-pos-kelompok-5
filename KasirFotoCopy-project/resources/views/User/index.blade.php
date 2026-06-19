{{-- Notif berhasil atau error --}}
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

<br>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
<br>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Username</th>
            <th>Nama Lengkap</th>
            <th>Shift</th>
            <th>Status</th>
            <th>Absensi (Punya lu doang)</th>
            <th>Opsi Lain</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user as $item)
        <tr>
            <td>{{ $item->username }}</td>
            <td>{{ $item->nama_lengkap }}</td>
            <td>{{ $item->shift }}</td>
            <td>{{ $item->status }}</td>

            <td>
                @if(Auth::id() == $item->id)
                    <form action="{{ route('absensi.checkin') }}" method="POST" style="display:inline;">
                        @csrf <button type="submit">Check In</button>
                    </form>
                    <form action="{{ route('absensi.checkout') }}" method="POST" style="display:inline;">
                        @csrf <button type="submit">Check Out</button>
                    </form>
                @else
                    -
                @endif
            </td>
            
            {{-- Aksi buat admin/owner --}}
            <td>
                {{-- Edit bisa semua user --}}
                <a href="/user/{{ $item->id }}/edit">[ Edit ]</a> 

                {{-- Fitur khusus Admin & Owner --}}
                @if(Auth::user()->role != 'Kasir')
                    &nbsp;|&nbsp;
                    <a href="{{ route('user.cetak-data', $item->id) }}" target="_blank">[ Cetak ]</a>
                    
                    <form action="{{ route('user.reset-password', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" onclick="return confirm('Reset password ke 12345?')">Reset Pass</button>
                    </form>
                @endif

                {{-- Hapus data --}}
                @if(Auth::user()->role == 'Owner' || (Auth::user()->role == 'Admin' && $item->role == 'Kasir'))
                    <form action="/user/{{ $item->id }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus {{ $item->nama_lengkap }}?')">Hapus</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>