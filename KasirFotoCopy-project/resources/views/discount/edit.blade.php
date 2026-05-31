<h1>Ubah Data Promo</h1>
<form method="POST" action="{{ route('discounts.update', $discount) }}">
    @csrf @method('PUT')
    <p>Nama Promo: <input type="text" name="promo_name" value="{{ $discount->promo_name }}" required></p>
    <p>Diskon (%): <input type="number" name="percentage" value="{{ $discount->percentage }}" min="1" max="100" required></p>
    <p>Status:
        <select name="is_active">
            <option value="1" {{ $discount->is_active ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ !$discount->is_active ? 'selected' : '' }}>Non-Aktif</option>
        </select>
    </p>
    <button type="submit">Update</button>
</form>
<br><a href="{{ route('discounts.index') }}">Kembali</a>