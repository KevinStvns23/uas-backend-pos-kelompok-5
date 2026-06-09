<h1>Tambah Promo Baru</h1>
<form method="POST" action="{{ route('discounts.store') }}">
    @csrf
    <p>Nama Promo: <input type="text" name="promo_name" required></p>
    <p>Diskon (%): <input type="number" name="percentage" min="1" max="100" required></p>
    <p>Status:
        <select name="is_active">
            <option value="1">Aktif</option>
            <option value="0">Non-Aktif</option>
        </select>
    </p>
    <button type="submit">Simpan</button>
</form>
<br><a href="{{ route('discounts.index') }}">Kembali</a>