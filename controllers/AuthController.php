<?php

class AuthController extends Controller {

    private function startSession(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        $this->startSession();
        $this->view('auth/login');
    }

    public function login() {
        $this->startSession();

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->model('User')->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id'       => $user['id_user'],
                'username' => $user['username'],
                'role'     => $user['role']
            ];

            header("Location: " . BASE_URL . "/dashboard");
            exit;
        }

        $this->view('auth/login', [
            'error' => 'Username atau password salah'
        ]);
    }

    public function logout() {
        $this->startSession();
        session_destroy();

        header("Location: " . BASE_URL);
        exit;
    }
}
