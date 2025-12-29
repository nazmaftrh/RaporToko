<h2>Tambah Produk</h2>

<div class="form-box">
<form action="<?= BASE_URL ?>/produk/store" method="POST">

    <div class="form-group">
        <label>Nama Produk</label><br><br>
        <input type="text"
               name="nama_produk"
               class="input-text"
               required>
    </div>

    <div class="form-group">
        <label>Kategori</label><br><br>
        <select name="id_kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($data['kategori'] as $k): ?>
                <option value="<?= $k['id_kategori'] ?>">
                    <?= htmlspecialchars($k['nama_kategori']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>

    <a href="<?= BASE_URL ?>/produk" class="btn btn-secondary">
        Batal
    </a>

</form>
</div>
