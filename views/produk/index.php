<h2>Data Produk</h2>

<?php if ($_SESSION['user']['role'] === 'admin'): ?>
<div class="top-action">
    <a href="<?= BASE_URL ?>/produk/add" class="btn btn-primary">Tambah</a>
</div>
<?php endif; ?>

<table>
    <tr>
        <th style="width:60px;">No</th>
        <th>Nama Produk</th>
        <th>Kategori</th>

        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <th style="width:140px;">Aksi</th>
        <?php endif; ?>
    </tr>

    <?php $no=1; foreach ($data['produk'] as $prd): ?>
    <tr>
        <td class="text-center">
            <div class="aksi-cell">
                <?= $no++ ?>
            </div></td>
        <td><?= htmlspecialchars($prd['nama_produk']) ?></td>
        <td><?= htmlspecialchars($prd['nama_kategori']) ?></td>

        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <td class="text-center">
            <div class="aksi-cell">
                <a href="<?= BASE_URL ?>/produk/edit/<?= $prd['id_produk'] ?>"
                class="aksi-btn btn-edit">✏️</a>

                <a href="<?= BASE_URL ?>/produk/delete/<?= $prd['id_produk'] ?>"
                onclick="return confirm('Yakin ingin menghapus produk ini?')"
                class="aksi-btn btn-hapus">🗑️</a>
            </div>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
