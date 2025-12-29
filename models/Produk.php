<?php

class Produk {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function countProduk() {
        $this->db->query("SELECT COUNT(*) AS total FROM produk");
        return $this->db->single();
    }

    public function getAll() {
        $this->db->query("
            SELECT produk.*, kategori.nama_kategori
            FROM produk
            JOIN kategori ON produk.id_kategori = kategori.id_kategori
            ORDER BY id_produk DESC
        ");
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query("SELECT * FROM produk WHERE id_produk = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function add($data) {
        $this->db->query("
            INSERT INTO produk (nama_produk, id_kategori)
            VALUES (:nama, :kategori)
        ");
        $this->db->bind('nama', $data['nama_produk']);
        $this->db->bind('kategori', $data['id_kategori']);
        return $this->db->execute();
    }

    public function updateProduk($data) {
        $this->db->query("
            UPDATE produk 
            SET nama_produk = :nama,
                id_kategori = :kategori
            WHERE id_produk = :id
        ");
        $this->db->bind('nama', $data['nama_produk']);
        $this->db->bind('kategori', $data['id_kategori']);
        $this->db->bind('id', $data['id_produk']);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM produk WHERE id_produk = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    public function getAllWithKategori() {
        $this->db->query("
            SELECT p.*, k.nama_kategori
            FROM produk p
            JOIN kategori k ON p.id_kategori = k.id_kategori
            ORDER BY k.nama_kategori, p.nama_produk
        ");
        return $this->db->resultSet();
    }
}
