<h2>Detail Surat</h2>

<div class="form-box">
    <p>
        <b>Tanggal Kirim:</b><br>
        <?= htmlspecialchars($data['surat']['tanggal_kirim']) ?>
    </p>

    <p>
        <b>Status:</b><br>
        <?= ucfirst(htmlspecialchars($data['surat']['status'])) ?>
    </p>
</div>

<form action="<?= BASE_URL ?>/surat/storeDetail" method="POST">

<input type="hidden" name="id_surat"
       value="<?= $data['surat']['id_surat'] ?>">

<h3 style="margin-top:30px;">Detail Produk</h3>

<table>
    <tr>
        <th style="width:60px;">No</th>
        <th>Kategori</th>
        <th>Produk</th>
        <th style="width:120px;">Jumlah Kirim</th>
    </tr>

    <?php $no = 1; ?>
    <?php foreach ($data['produk'] as $p): ?>
    <tr>
        <td style="text-align:center;">
            <?= $no++ ?>
        </td>

        <td><?= htmlspecialchars($p['nama_kategori']) ?></td>

        <td><?= htmlspecialchars($p['nama_produk']) ?>
            <input type="hidden" name="id_produk[]" value="<?= $p['id_produk'] ?>">
            <input type="hidden" name="nama_produk[]" value="<?= $p['nama_produk'] ?>">
            <input type="hidden" name="nama_kategori[]" value="<?= $p['nama_kategori'] ?>">
        </td>

        <td style="text-align:center;">
            <input type="number"
                   name="jumlah[]"
                   min="0"
                   class="input-text"
                   style="width:80px;">
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div style="margin-top:20px;">
    <button type="submit" class="btn btn-primary">
        Simpan Produk
    </button>

    <a href="<?= BASE_URL ?>/surat" class="btn btn-secondary">
        Batal
    </a>
</div>

</form>
