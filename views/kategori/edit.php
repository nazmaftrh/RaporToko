<h2>Edit Kategori</h2>

<div class="form-box">
<form action="<?= BASE_URL ?>/kategori/update/<?= $data['kategori']['id_kategori'] ?>" method="post">

    <div class="form-group">
        <label>Nama Kategori</label><br><br>
        <input type="text"
               name="nama_kategori"
               class="input-text"
               value="<?= htmlspecialchars($data['kategori']['nama_kategori']) ?>"
               required>
    </div>

    <button type="submit" class="btn btn-primary">
        Update
    </button>

    <a href="<?= BASE_URL ?>/kategori" class="btn btn-secondary">
        Batal
    </a>

</form>
</div>
