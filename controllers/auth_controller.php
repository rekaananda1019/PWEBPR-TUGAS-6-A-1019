<?php

include_once 'model/user.php';

class AuthController {
    static function login() {
        require_once("conn.php");
        require_once("dashboard.php");
        // Jika sudah login, arahkan ke dashboard
        if(isset($_SESSION['user'])){
            header('Location: '.BASEURL.'dashboard');
            exit();
        }
        view('auth/layout', ['url' => 'login']);
    }

    static function register() {
        require_once("conn.php");
        require_once("dashboard.php");
        // Jika sudah login, arahkan ke dashboard
        if(isset($_SESSION['user'])){
            header('Location: '.BASEURL.'dashboard');
            exit();
        }
        view('auth/layout', ['url' => 'register']);
    }

    static function saveLogin() {
        require_once("conn.php");
        require_once("dashboard.php");
        // Jika sudah login, arahkan ke dashboard
        if(isset($_SESSION['user'])){
            header('Location: '.BASEURL.'dashboard');
            exit();
        }
        $post = array_map('htmlspecialchars', $_POST);

        $user = User::login([
            'email' => $post['email'], 
            'password' => $post['password']
        ]);
        if ($user) {
            unset($user['password']);
            $_SESSION['user'] = $user;
            header('Location: '.BASEURL.'dashboard');
        }
        else {
            header('Location: '.BASEURL.'login?failed=true');
        }
    }

    static function saveRegister() {
        require_once("conn.php");
        require_once("dashboard.php");
        // Jika sudah login, arahkan ke dashboard
        if(isset($_SESSION['user'])){
            header('Location: '.BASEURL.'dashboard');
            exit();
        }
        $post = array_map('htmlspecialchars', $_POST);

        $user = User::register([
            'name' => $post['name'], 
            'email' => $post['email'], 
            'password' => $post['password']
        ]);

        if ($user) {
            header('Location: '.BASEURL.'login');
        }
        else {
            header('Location: '.BASEURL.'register?failed=true');
        }
    }

    static function logout() {
        session_start();
        // Hapus sesi pengguna
        session_unset();
        // Hancurkan sesi
        session_destroy();
        // Redirect ke halaman login setelah logout
        header('Location: '.BASEURL.'login');
        exit();
    }

    static function forgotPassword() {}
}
