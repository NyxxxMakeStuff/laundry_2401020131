
<div class="mb-3">
    <label for="kode_pesanan" class="form-label">Kode Pesanan</label>
    <input
        type="text"
        id="kode_pesanan"
        name="kode_pesanan"
        maxlength="10"
        required
        pattern="[A-Za-z0-9]{10}"
        class="form-control"
        value="{{ old('kode_pesanan', $pesanan->kode_pesanan ?? '') }}"
    >
    <small class="text-muted">Tepat 10 karakter alfanumerik.</small>
</div>

<div class="mb-3">
    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
    <input
        type="text"
        id="nama_pelanggan"
        name="nama_pelanggan"
        minlength="3"
        maxlength="100"
        required
        class="form-control"
        value="{{ old('nama_pelanggan', $pesanan->nama_pelanggan ?? '') }}"
    >
</div>

<div class="mb-3">
    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
    <input
        type="tel"
        id="nomor_telepon"
        name="nomor_telepon"
        minlength="10"
        maxlength="20"
        required
        class="form-control"
        value="{{ old('nomor_telepon', $pesanan->nomor_telepon ?? '') }}"
    >
</div>

<div class="mb-3">
    <label for="berat_kg" class="form-label">Berat (kg)</label>
    <input
        type="number"
        id="berat_kg"
        name="berat_kg"
        min="1"
        max="20"
        step="1"
        required
        class="form-control"
        value="{{ old('berat_kg', $pesanan->berat_kg ?? '') }}"
    >
</div>

<div class="mb-3">
    <label for="jenis_layanan_id" class="form-label">
        Jenis Layanan
    </label>
    <select
        id="jenis_layanan_id"
        name="jenis_layanan_id"
        class="form-select"
        required
    >
        <option value="">-- Pilih Layanan --</option>

        @foreach ($jenisLayanan as $layanan)
            <option
                value="{{ $layanan->id }}"
                @selected((string) old(
                    'jenis_layanan_id',
                    $pesanan->jenis_layanan_id ?? ''
                ) === (string) $layanan->id)
            >
                {{ $layanan->nama_layanan }}
            </option>
        @endforeach
    </select>
</div>


<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('pesanan-laundry.index') }}"
   class="btn btn-secondary">
    Batal
</a>
