<h2>Tambah Kategori</h2>

<div class="form-box">
<form action="<?= BASE_URL ?>/kategori/store" method="POST">

    <div class="form-group">
        <label>Nama Kategori</label><br><br>
        <input type="text"
               name="nama_kategori"
               class="input-text"
               required>
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>

    <a href="<?= BASE_URL ?>/kategori" class="btn btn-secondary">
        Batal
    </a>

</form>
</div>
