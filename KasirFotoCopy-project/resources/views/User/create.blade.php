<h1>Menambah User</h1>

<form action="{{ route('user.store') }}" method="POST">
    @csrf

    <label>Username:</label>
    <input type="text" name="username" required><br><br>

    <label>Password:</label>
    <div style="position: relative; display: inline-block;">
        <input type="password" name="password" id="pass" required style="padding-right: 40px;">
        <span onclick="lihat()" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 12px; font-weight: bold;">Lihat</span>
    </div><br><br>

    <label>Nama Lengkap:</label>
    <input type="text" name="nama_lengkap" required><br><br>

    <label>Alamat:</label>
    <textarea name="alamat" required></textarea><br><br>

    <label>No Telp:</label>
    <input type="number" name="no_telp" required><br><br>

    <label>Shift:</label>
    <select name="shift" required>
        <option value="Shift 1">Shift 1</option>
        <option value="Shift 2">Shift 2</option>
        <option value="Full">Full</option>
    </select><br><br>

    <label>Role:</label>
    <select name="role" required>
        <option value="Kasir">Kasir</option>
        <option value="Admin">Admin</option>
        <option value="Owner">Owner</option>
    </select><br><br>

    <button type="submit">Simpan Data</button>
    <a href="/user">Batal</a>
</form>

<script>
    function lihat() {
        var x = document.getElementById("pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>