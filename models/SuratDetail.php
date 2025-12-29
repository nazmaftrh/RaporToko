<?php

class SuratDetail
{
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function add($data) {
        $this->db->query("
            INSERT INTO surat_detail
            (id_surat, id_produk, jumlah_kirim, nama_produk, nama_kategori)
            VALUES
            (:id_surat, :id_produk, :jumlah, :nama_produk, :nama_kategori)
        ");

        $this->db->bind('id_surat', $data['id_surat']);
        $this->db->bind('id_produk', $data['id_produk']);
        $this->db->bind('jumlah', $data['jumlah_kirim']);
        $this->db->bind('nama_produk', $data['nama_produk']);
        $this->db->bind('nama_kategori', $data['nama_kategori']);

        return $this->db->execute();
    }

    public function getBySurat($id) {
        $this->db->query("SELECT * FROM surat_detail WHERE id_surat = :id");
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function update($data) {
        $this->db->query("
            UPDATE surat_detail
            SET jumlah_kirim = :jumlah
            WHERE id_detail = :id
        ");

        $this->db->bind('jumlah', $data['jumlah_kirim']);
        $this->db->bind('id', $data['id_detail']);

        return $this->db->execute();
    }

    public function deleteBySurat($id_surat) {
        $this->db->query("DELETE FROM surat_detail WHERE id_surat = :id");
        $this->db->bind('id', $id_surat);
        return $this->db->execute();
    }
}
