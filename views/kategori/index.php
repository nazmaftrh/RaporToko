<h2>Data Kategori</h2>

<?php if ($_SESSION['user']['role'] === 'admin'): ?>
<div class="top-action">
    <a href="<?= BASE_URL ?>/kategori/add" class="btn btn-primary">Tambah</a>
</div>
<?php endif; ?>

<table>
    <tr>
        <th style="width:60px;">No</th>
        <th>Nama Kategori</th>

        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <th style="width:160px;">Aksi</th>
        <?php endif; ?>
    </tr>

    <?php $no = 1; foreach ($data['kategori'] as $kat): ?>
    <tr>
        <td class="text-center">
            <div class="aksi-cell">
                <?= $no++ ?>
            </div></td>
        <td><?= htmlspecialchars($kat['nama_kategori']) ?></td>

        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <td class="text-center">
            <div class="aksi-cell">
                <a href="<?= BASE_URL ?>/kategori/edit/<?= $kat['id_kategori'] ?>"
                class="aksi-btn btn-edit">✏️</a>

                <a href="<?= BASE_URL ?>/kategori/delete/<?= $kat['id_kategori'] ?>"
                onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                class="aksi-btn btn-hapus">🗑️</a>
            </div>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
