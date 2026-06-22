<style>
    .grid-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 10px;
        width: 100%;
        max-width: 1000px;
    }
    .user-card {
        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        background-color: #f9f9f9;
        width: 220px; 
    }
    .action-group {
        margin-top: 15px;
        font-size: 14px;
    }
    .action-group form {
        display: inline;
    }
</style>

<div style="display: flex; flex-direction: column; align-items: center; padding: 20px;">
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 10px; width: 100%; max-width: 500px; text-align: center; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px; width: 100%; max-width: 500px; text-align: center; border-radius: 5px;">
            {{ session('error') }}
        </div>
    @endif

    <h1>Daftar User</h1>

    <div style="margin-bottom: 15px;">
        @if(Auth::user()->role != 'Kasir')
            <a href="/user/create" style="background: #007bff; color: white; padding: 8px 15px; text-decoration: none; border-radius: 5px; margin-right: 10px;">+ Tambah User</a>
        @endif
        <a href="{{ route('absensi.rekap') }}" style="background: #17a2b8; color: white; padding: 8px 15px; text-decoration: none; border-radius: 5px;">[ Lihat Rekapan Absensi ]</a>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" style="margin-bottom: 15px; padding: 5px 15px; cursor: pointer;">Logout</button>
    </form>

    <div class="grid-container">
        @foreach($user as $item)
        <div class="user-card">
            <h3>{{ $item->nama_lengkap }}</h3>
            <p style="margin: 0; color: gray;">{{ $item->username }}</p>
            <p><strong>Shift:</strong> {{ $item->shift }}</p>

            <div style="margin-bottom: 10px;">
                <strong>Status: </strong>
                <span style="background: {{ $item->status == 'Aktif' ? '#d4edda' : '#f8d7da' }}; color: {{ $item->status == 'Aktif' ? '#155724' : '#721c24' }}; padding: 2px 8px; border-radius: 4px;">
                    {{ $item->status }}
                </span>
            </div>

            @if(Auth::id() == $item->id)
                <div style="margin-top: 10px;">
                    <form action="{{ route('absensi.checkin') }}" method="POST" style="display:inline;">
                        @csrf 
                        <button type="submit" style="background: #28a745; color: white; border: none; padding: 5px 10px; cursor: pointer;">Check In</button>
                    </form>
                    <form action="{{ route('absensi.checkout') }}" method="POST" style="display:inline;">
                        @csrf 
                        <button type="submit" style="background: #dc3545; color: white; border: none; padding: 5px 10px; cursor: pointer;">Check Out</button>
                    </form>
                </div>
            @endif

            <hr style="margin: 15px 0;">

            <div class="action-group">
                <a href="/user/{{ $item->id }}">[ Detail ]</a> 

                @if( !(Auth::user()->role == 'Admin' && $item->role == 'Owner') )
                    &nbsp;|&nbsp; 
                    <a href="/user/{{ $item->id }}/edit">[ Edit ]</a> 
                @endif
                
                @if(Auth::user()->role != 'Kasir')
                    @if( !(Auth::user()->role == 'Admin' && $item->role == 'Owner') )
                        <br><br>
                        <form action="{{ route('user.reset-password', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" onclick="return confirm('Reset password ke 12345?')">Reset Pass</button>
                        </form>
                    @endif
                @endif

                @if(Auth::user()->role == 'Owner' || (Auth::user()->role == 'Admin' && $item->role == 'Kasir'))
                    <br>
                    <form action="/user/{{ $item->id }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm ('Yakin hapus data ini?')" style="margin-top: 5px; color: red;">Hapus Data</button>
                    </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>