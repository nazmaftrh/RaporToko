<?php

class ProdukController extends Controller {

    public function index() {
        $data['produk'] = $this->model('Produk')->getAll();
        $data['title'] = "Data Produk";
        $this->viewWithLayout('produk/index', $data);
    }

    public function add() {
        $this->onlyAdmin();
        $data['kategori'] = $this->model('Kategori')->getAll();
        $data['title'] = "Tambah Produk";
        $this->viewWithLayout('produk/add', $data);
    }

    public function store() {
        $this->onlyAdmin();

        $this->model('Produk')->add([
            'nama_produk' => $_POST['nama_produk'],
            'id_kategori' => $_POST['id_kategori']
        ]);

        $this->flash('success', 'Produk berhasil ditambahkan');

        header("Location: " . BASE_URL . "/produk");
        exit;
    }

    public function edit($id) {
        $this->onlyAdmin();
        $data['produk'] = $this->model('Produk')->getById($id);
        $data['kategori'] = $this->model('Kategori')->getAll();
        $data['title'] = "Edit Produk";
        $this->viewWithLayout('produk/edit', $data);
    }

    public function update($id) {
        $this->onlyAdmin();

        $this->model('Produk')->updateProduk([
            'id_produk' => $id,
            'nama_produk' => $_POST['nama_produk'],
            'id_kategori' => $_POST['id_kategori']
        ]);

        $this->flash('success', 'Produk berhasil diperbarui');

        header("Location: " . BASE_URL . "/produk");
        exit;
    }

    public function delete($id) {
        $this->onlyAdmin();
        try {
            $this->model('Produk')->delete($id);
            $this->flash('success', 'Produk berhasil dihapus');
        } 
        catch (PDOException $e) {
            $this->flash('error', 'Produk tidak bisa dihapus karena masih digunakan surat jalan');
        }
        header("Location: " . BASE_URL . "/produk");
    }
}
