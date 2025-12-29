<?php
$isAdmin = isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
?>

<h2>Data Surat</h2>

<div class="top-action">
    <?php if ($isAdmin): ?>
        <a href="<?= BASE_URL ?>/surat/add" class="btn btn-primary">Tambah</a>
    <?php endif; ?>

    <button onclick="openPdfModal()" class="btn btn-secondary">Export PDF</button>
</div>

<table>
    <tr>
        <th style="width:60px;">No</th>
        <th>Tanggal Kirim</th>
        <th style="width:120px;">Status</th>
        <th style="width:160px;">Aksi</th>
    </tr>

    <?php $no=1; foreach ($data['surat'] as $s): ?>
    <tr>
        <td class="text-center">
            <div class="aksi-cell">
                <?= $no++ ?>
            </div></td>
        <td><?= htmlspecialchars($s['tanggal_kirim']) ?></td>
        <td><?= ucfirst($s['status']) ?></td>
        <td class="text-center">
            <div class="aksi-cell">
                <a href="<?= BASE_URL ?>/surat/detail/<?= $s['id_surat'] ?>"
                class="aksi-btn btn-detail">🔍</a>

                <?php if ($isAdmin): ?>
                    <a href="<?= BASE_URL ?>/surat/edit/<?= $s['id_surat'] ?>"
                    class="aksi-btn btn-edit">✏️</a>

                    <a href="<?= BASE_URL ?>/surat/delete/<?= $s['id_surat'] ?>"
                    onclick="return confirm('Yakin hapus surat ini?')"
                    class="aksi-btn btn-hapus">🗑️</a>
                <?php endif; ?>

                <?php if (!$isAdmin && $s['status'] === 'draft'): ?>
                    <a href="<?= BASE_URL ?>/surat/terima/<?= $s['id_surat'] ?>"
                    class="aksi-btn btn-primary"
                    onclick="return confirm('Terima surat jalan ini?')">
                    ✅
                    </a>
                <?php endif; ?>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div id="pdfModal">
    <div class="modal-box">
        <h3>Pilih Tanggal</h3>

        <form action="<?= BASE_URL ?>/surat/pdf" method="POST">
            <label>Dari Tanggal</label><br><br>
            <input type="date" name="tgl_awal" required><br><br>

            <label>Sampai Tanggal</label><br><br>
            <input type="date" name="tgl_akhir" required><br><br>

            <button type="submit" class="btn btn-primary">Export PDF</button>
            <button type="button" class="btn btn-secondary" onclick="closePdfModal()">Batal</button>
        </form>
    </div>
</div>

<script>
function openPdfModal() {
    document.getElementById('pdfModal').style.display = 'block';
}
function closePdfModal() {
    document.getElementById('pdfModal').style.display = 'none';
}
</script>

