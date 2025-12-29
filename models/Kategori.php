<?php

class Kategori {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query("SELECT * FROM kategori ORDER BY id_kategori DESC");
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query("SELECT * FROM kategori WHERE id_kategori = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function add($nama) {
        $this->db->query("INSERT INTO kategori (nama_kategori) VALUES (:nama)");
        $this->db->bind('nama', $nama);
        return $this->db->execute();
    }

    public function updateKategori($id, $nama) {
        $this->db->query("UPDATE kategori SET nama_kategori = :nama WHERE id_kategori = :id");
        $this->db->bind('nama', $nama);
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM kategori WHERE id_kategori = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
