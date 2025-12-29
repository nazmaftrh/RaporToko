<h2>Edit Produk</h2>

<div class="form-box">
<form action="<?= BASE_URL ?>/produk/update/<?= $data['produk']['id_produk'] ?>" method="post">

    <div class="form-group">
        <label>Nama Produk</label><br><br>
        <input type="text"
               name="nama_produk"
               class="input-text"
               value="<?= htmlspecialchars($data['produk']['nama_produk']) ?>"
               required>
    </div>

    <div class="form-group">
        <label>Kategori</label><br><br>
        <select name="id_kategori" required>
            <?php foreach ($data['kategori'] as $kat): ?>
                <option value="<?= $kat['id_kategori'] ?>"
                    <?= $kat['id_kategori'] == $data['produk']['id_kategori'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($kat['nama_kategori']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        Update
    </button>

    <a href="<?= BASE_URL ?>/produk" class="btn btn-secondary">
        Batal
    </a>

</form>
</div>
