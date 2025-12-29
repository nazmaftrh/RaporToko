<?php

class Surat
{
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function add($data) {
        $this->db->query("INSERT INTO surat (tanggal_kirim, status, catatan) VALUES (:tanggal, :status, :catatan)");
        $this->db->bind('tanggal', $data['tanggal_kirim']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('catatan', $data['catatan']);

        $this->db->execute();

        return $this->db->lastInsertId();
    }

    public function getById($id) {
        $this->db->query("SELECT * FROM surat WHERE id_surat = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getAll() {
        $this->db->query("SELECT *FROM surat ORDER BY tanggal_kirim DESC");
        return $this->db->resultSet();
    }

    public function update($data) {
        $this->db->query("UPDATE surat SET
                            tanggal_kirim = :tanggal,
                            status = :status,
                            catatan = :catatan
                        WHERE id_surat = :id");

        $this->db->bind('tanggal', $data['tanggal_kirim']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('catatan', $data['catatan']);
        $this->db->bind('id', $data['id_surat']);

        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM surat WHERE id_surat = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    public function getByTanggal($awal, $akhir) {
        $this->db->query("SELECT * FROM surat WHERE tanggal_kirim BETWEEN :awal AND :akhir ORDER BY tanggal_kirim ASC");
        $this->db->bind('awal', $awal);
        $this->db->bind('akhir', $akhir);

        return $this->db->resultSet();
    }

    public function updateStatus($id, $status) {
        $this->db->query("UPDATE surat SET status = :status WHERE id_surat = :id");
        $this->db->bind('status', $status);
        $this->db->bind('id', $id);

        return $this->db->execute();
    }
}
