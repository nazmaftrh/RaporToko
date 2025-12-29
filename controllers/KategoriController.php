<?php

class KategoriController extends Controller {

    public function index() {
        $data['kategori'] = $this->model('Kategori')->getAll();
        $data['title'] = "Data Kategori";
        $this->viewWithLayout('kategori/index', $data);
    }

    public function add() {
        $this->onlyAdmin();
        $data['title'] = "Tambah Kategori";
        $this->viewWithLayout('kategori/add', $data);
    }

    public function store() {
        $this->onlyAdmin();
        $this->model('Kategori')->add($_POST['nama_kategori']);
        $this->flash('success', 'Kategori berhasil ditambahkan');
        header("Location: " . BASE_URL . "/kategori");
    }

    public function edit($id) {
        $this->onlyAdmin();
        $data['kategori'] = $this->model('Kategori')->getById($id);
        $data['title'] = "Edit Kategori";
        $this->viewWithLayout('kategori/edit', $data);
    }

    public function update($id) {
        $this->onlyAdmin();
        $this->model('Kategori')->updateKategori($id, $_POST['nama_kategori']);
        $this->flash('success', 'Kategori berhasil diperbarui');
        header("Location: " . BASE_URL . "/kategori");
    }

    public function delete($id) {
        $this->onlyAdmin();
        try {
            $this->model('Kategori')->delete($id);
            $this->flash('success', 'Kategori berhasil dihapus');
        } 
        catch (PDOException $e) {
            $this->flash('error', 'Kategori tidak bisa dihapus karena masih digunakan produk');
        }

        header("Location: " . BASE_URL . "/kategori");
    }
}
