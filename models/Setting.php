<?php

class Setting {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function get($name) {
        $this->db->query("SELECT value FROM settings WHERE name=:name");
        $this->db->bind('name', $name);
        return $this->db->single()['value'] ?? '';
    }
}
