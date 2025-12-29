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

    <p>
        <b>Catatan:</b><br>
        <?= htmlspecialchars($data['surat']['catatan'] ?? '-') ?>
    </p>

</div>

<h3 style="margin-top:30px;">Detail Produk</h3>

<table>
    <tr>
        <th style="width:60px;">No</th>
        <th>Kategori</th>
        <th>Produk</th>
        <th style="width:120px;">Jumlah Kirim</th>
    </tr>

    <?php if (empty($data['detail'])): ?>
        <tr>
            <td colspan="4" style="text-align:center;">
                Belum ada produk
            </td>
        </tr>
    <?php else: ?>
        <?php $no = 1; ?>
        <?php foreach ($data['detail'] as $d): ?>
        <tr>
            <td style="text-align:center;"><?= $no++ ?></td>
            <td><?= htmlspecialchars($d['nama_kategori']) ?></td>
            <td><?= htmlspecialchars($d['nama_produk']) ?></td>
            <td style="text-align:center;"><?= $d['jumlah_kirim'] ?></td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<div style="margin-top:20px;">
    <a href="<?= BASE_URL ?>/surat" class="btn btn-primary">
        Kembali
    </a>
</div>
