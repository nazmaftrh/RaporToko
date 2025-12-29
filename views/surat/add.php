<h2>Tambah Surat Jalan</h2>

<div class="form-box">
<form action="<?= BASE_URL ?>/surat/store" method="POST">

    <div class="form-group">
        <label>Tanggal Kirim</label><br><br>
        <input type="date"
               name="tanggal_kirim"
               class="input-text"
               required>
    </div>

    <div class="form-group">
        <label>Status</label><br><br>
        <select name="status">
            <option value="draft">Draft</option>
            <option value="terkirim">Terkirim</option>
            <option value="selesai">Selesai</option>
        </select>
    </div>

    <div class="form-group">
        <label>Catatan</label><br><br>
        <textarea name="catatan" rows="4"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan & Lanjut
    </button>

    <a href="<?= BASE_URL ?>/surat" class="btn btn-secondary">
        Batal
    </a>

</form>
</div>
