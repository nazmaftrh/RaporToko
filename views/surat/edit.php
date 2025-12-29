<h2>Edit Surat</h2>

<form action="<?= BASE_URL ?>/surat/update/<?= $data['surat']['id_surat'] ?>" method="POST">

<div class="form-box">

    <div class="form-group">
        <label>Tanggal Kirim</label><br><br>
        <input type="date"
               name="tanggal_kirim"
               class="input-text"
               value="<?= htmlspecialchars($data['surat']['tanggal_kirim']) ?>"
               required>
    </div>

    <div class="form-group">
        <label>Status</label><br><br>
        <select name="status">
            <option value="draft" <?= $data['surat']['status']=='draft'?'selected':'' ?>>Draft</option>
            <option value="terkirim" <?= $data['surat']['status']=='terkirim'?'selected':'' ?>>Terkirim</option>
            <option value="selesai" <?= $data['surat']['status']=='selesai'?'selected':'' ?>>Selesai</option>
        </select>
    </div>

    <div class="form-group">
        <label>Catatan</label><br><br>
        <textarea name="catatan" rows="4"><?= htmlspecialchars($data['surat']['catatan']) ?></textarea>
    </div>

</div>

<h3 style="margin-top:30px;">Detail Produk</h3>

<table>
    <tr>
        <th style="width:60px;">No</th>
        <th>Kategori</th>
        <th>Produk</th>
        <th style="width:120px;">Jumlah Kirim</th>
    </tr>

    <?php $no=1; foreach ($data['detail'] as $d): ?>
    <tr>
        <td style="text-align:center;"><?= $no++ ?></td>
        <td><?= htmlspecialchars($d['nama_kategori']) ?></td>
        <td><?= htmlspecialchars($d['nama_produk']) ?></td>
        <td style="text-align:center;">
            <input type="hidden" name="id_detail[]" value="<?= $d['id_detail'] ?>">
            <input type="number"
                   name="jumlah[]"
                   value="<?= $d['jumlah_kirim'] ?>"
                   min="0"
                   style="width:80px;padding:6px;">
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div style="margin-top:25px;">
    <button type="submit" class="btn btn-primary">
        Simpan Perubahan
    </button>

    <a href="<?= BASE_URL ?>/surat" class="btn btn-secondary">
        Batal
    </a>
</div>

</form>
