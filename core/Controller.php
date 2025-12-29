<?php
require_once '../app/core/Database.php';

class Controller {

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    public function view($view, $data = []) {
        extract($data);
        require_once '../app/views/' . $view . '.php';
    }

    public function viewWithLayout($view, $data = []) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL);
            exit;
        }

        $setting = $this->model('Setting');

        $data['setting'] = [
            'app_name'      => $setting->get('app_name'),
            'app_subtitle'  => $setting->get('app_subtitle'),
            'footer_left'   => $setting->get('footer_left'),
            'footer_center' => $setting->get('footer_center'),
        ];

        extract($data);
        require_once '../app/views/layout/header.php';
        require_once '../app/views/' . $view . '.php';
        require_once '../app/views/layout/footer.php';
    }

    protected function flash($type, $message) {
        $_SESSION['flash'] = [
            'type' => $type, 
            'message' => $message
        ];
    }

    protected function onlyAdmin() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die('❌ Akses ditolak. Halaman khusus admin.');
        }
    }
}
