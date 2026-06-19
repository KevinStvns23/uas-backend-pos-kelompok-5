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
            <th>Aksi</th>
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
                <a href="/user/{{ $item->id }}/edit">[ Edit ]</a> 
                &nbsp;|&nbsp; 
                
                <form action="/user/{{ $item->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin mau hapus data ini?')">Hapus</button>
                </form>
            </td>
            </tr>
        @endforeach
    </tbody>
</table>