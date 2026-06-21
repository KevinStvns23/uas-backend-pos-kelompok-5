<div style="padding: 20px; max-width: 600px; margin: 0 auto; border: 1px solid #ccc; border-radius: 8px;">
    <h2>Detail Data </h2>
    <hr>
    
    <p><strong>Nama:</strong> {{ $user->nama_lengkap }}</p>
    <p><strong>Username:</strong> {{ $user->username }}</p>
    <p><strong>Shift:</strong> {{ $user->shift }}</p>
    
    <p><strong>No. Telepon:</strong> 
        @if(Auth::user()->role == 'Admin' && $user->role == 'Owner')
            ********
        @else
            {{ $user->no_telp ?? '-' }}
        @endif
    </p>
    <p><strong>Alamat:</strong> 
        @if(Auth::user()->role == 'Admin' && $user->role == 'Owner')
            ******************
        @else
            {{ $user->alamat ?? '-' }}
        @endif
    </p>
    <br>
    <a href="/user" style="background: #6c757d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">Kembali</a>
</div>