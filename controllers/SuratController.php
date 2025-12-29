<?php

class SuratController extends Controller
{
    public function index() {
        $data['title'] = 'Data Surat';
        $data['surat'] = $this->model('Surat')->getAll();
        $this->viewWithLayout('surat/index', $data);
    }

    public function add() {
        $this->onlyAdmin();
        $data['title'] = 'Tambah Surat';
        $this->viewWithLayout('surat/add', $data);
    }

    public function store() {
        $id_surat = $this->model('Surat')->add([
            'tanggal_kirim' => $_POST['tanggal_kirim'],
            'status'        => $_POST['status'],
            'catatan'       => $_POST['catatan']
        ]);

        header("Location: " . BASE_URL . "/surat/input/$id_surat");
        exit;
    }

    public function input($id) {
        $data['title']  = 'Input Produk Surat';
        $data['surat']  = $this->model('Surat')->getById($id);
        $data['produk'] = $this->model('Produk')->getAllWithKategori();

        $this->viewWithLayout('surat/detail', $data);
    }

    public function storeDetail() {
        foreach ($_POST['id_produk'] as $i => $id_produk) {
            if (empty($_POST['jumlah'][$i])) continue;

            $this->model('SuratDetail')->add([
                'id_surat'      => $_POST['id_surat'],
                'id_produk'     => $id_produk,
                'jumlah_kirim'  => $_POST['jumlah'][$i],
                'nama_produk'   => $_POST['nama_produk'][$i],
                'nama_kategori' => $_POST['nama_kategori'][$i],
            ]);
        }
        
        $this->flash('success', 'Surat Jalan berhasil ditambahkan');

        header("Location: " . BASE_URL . "/surat/show/" . $_POST['id_surat']);
        exit;
    }

    public function show($id) {
        $data['title']  = 'Detail Surat';
        $data['surat']  = $this->model('Surat')->getById($id);
        $data['detail'] = $this->model('SuratDetail')->getBySurat($id);

        $this->viewWithLayout('surat/show', $data);
    }

    public function detail($id) {
        $data['surat']  = $this->model('Surat')->getById($id);
        $data['detail'] = $this->model('SuratDetail')->getBySurat($id);
        $data['title']  = 'Detail Surat';

        if (!$data['surat']) {
            die('Surat tidak ditemukan');
        }

        $this->viewWithLayout('surat/show', $data);
    }

    public function edit($id) {
        $this->onlyAdmin();
        $data['surat']  = $this->model('Surat')->getById($id);
        $data['detail'] = $this->model('SuratDetail')->getBySurat($id);
        $data['title']  = 'Edit Surat';

        if (!$data['surat']) {
            die('Surat tidak ditemukan');
        }

        $this->viewWithLayout('surat/edit', $data);
    }

    public function update($id) {
        $this->model('Surat')->update([
            'id_surat'     => $id,
            'tanggal_kirim'=> $_POST['tanggal_kirim'],
            'status'       => $_POST['status'],
            'catatan'      => $_POST['catatan']
        ]);

        foreach ($_POST['id_detail'] as $i => $id_detail) {
            $this->model('SuratDetail')->update([
                'id_detail'    => $id_detail,
                'jumlah_kirim' => $_POST['jumlah'][$i]
            ]);
        }

        $this->flash('success', 'Surat Jalan berhasil diperbarui');

        header("Location: " . BASE_URL . "/surat/detail/$id");
        exit;
    }

    public function delete($id) {
        $this->onlyAdmin();
        $this->model('SuratDetail')->deleteBySurat($id);
        $this->model('Surat')->delete($id);
        $this->flash('success', 'Surat Jalan berhasil dihapus');
        header("Location: " . BASE_URL . "/surat");
        exit;
    }

    public function pdf() {
        $tgl_awal  = $_POST['tgl_awal'] ?? '';
        $tgl_akhir = $_POST['tgl_akhir'] ?? '';

        if (!$tgl_awal || !$tgl_akhir) {
            die('Tanggal tidak valid');
        }

        $suratList = $this->model('Surat')
            ->getByTanggal($tgl_awal, $tgl_akhir);

        if (empty($suratList)) {
            die('Data surat tidak ditemukan');
        }

        require_once __DIR__ . '/../libraries/fpdf/fpdf.php';

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);

        $pdf->Cell(0, 10, 'LAPORAN SURAT JALAN', 0, 1, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, "Periode: $tgl_awal s/d $tgl_akhir", 0, 1);
        $pdf->Ln(3);

        foreach ($suratList as $s) {

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 8, "Tanggal: {$s['tanggal_kirim']} | Status: {$s['status']}", 0, 1);

            if (!empty($s['catatan'])) {
                $pdf->SetFont('Arial', '', 9);
                $pdf->MultiCell(0, 6, "Catatan: {$s['catatan']}");
            }

            $pdf->Ln(2);

            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(10, 7, 'No', 1);
            $pdf->Cell(70, 7, 'Produk', 1);
            $pdf->Cell(50, 7, 'Kategori', 1);
            $pdf->Cell(30, 7, 'Jumlah', 1);
            $pdf->Ln();

            $detail = $this->model('SuratDetail')
                ->getBySurat($s['id_surat']);

            $pdf->SetFont('Arial', '', 9);
            $no = 1;
            foreach ($detail as $d) {
                $pdf->Cell(10, 7, $no++, 1);
                $pdf->Cell(70, 7, $d['nama_produk'], 1);
                $pdf->Cell(50, 7, $d['nama_kategori'], 1);
                $pdf->Cell(30, 7, $d['jumlah_kirim'], 1);
                $pdf->Ln();
            }

            $pdf->Ln(5);
        }

        $pdf->Output('I', 'Laporan_Surat_Jalan.pdf');
    }

    public function terima($id) {
        if (!isset($_SESSION['user'])) {
            die('Akses ditolak');
        }

        if ($_SESSION['user']['role'] !== 'user') {
            die('Hanya user yang bisa menerima surat');
        }

        $this->model('Surat')->updateStatus($id, 'terkirim');
        $this->flash('success', 'Surat Jalan diterima');

        header("Location: " . BASE_URL . "/surat");
        exit;
    }
}
