<?php

include_once __DIR__ . "/../../config/conn.php";

class ContactController {
    static function add() {
        if (!isset($_SESSION['username'])) { // Menggunakan $_SESSION['username'] untuk memeriksa apakah pengguna sudah login
            header('Location: '.BASEURL.'login.php?auth=false'); // Mengubah BASEURL menjadi BASEURL.'login.php' untuk mengarahkan ke halaman login dengan benar
            exit;
        }
        else {
            include_once 'add_contact.php'; // Menggunakan include_once untuk memasukkan file add_contact.php
        }
    }

    static function saveAdd() {
        if (!isset($_SESSION['username'])) { // Menggunakan $_SESSION['username'] untuk memeriksa apakah pengguna sudah login
            header('Location: '.BASEURL.'login.php?auth=false'); // Mengubah BASEURL menjadi BASEURL.'login.php' untuk mengarahkan ke halaman login dengan benar
            exit;
        }
        else {
            $post = array_map('htmlspecialchars', $_POST);
            $sql = "INSERT INTO contact (no_hp, nama, email, tgl_lahir, jns_kelamin) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $post['no_hp'], $post['owner'], $post['email'], $post['tgl_lahir'], $post['jns_kelamin']);
            $stmt->execute();

            if ($stmt->affected_rows > 0) { // Menggunakan affected_rows untuk memeriksa apakah data telah berhasil disimpan
                header('Location: '.BASEURL.'dashboard.php'); // Mengubah BASEURL menjadi BASEURL.'dashboard.php' untuk mengarahkan ke halaman dashboard dengan benar
            }
            else {
                header('Location: '.BASEURL.'add_contact.php?addFailed=true'); // Mengubah BASEURL menjadi BASEURL.'add_contact.php' untuk mengarahkan kembali ke halaman add_contact dengan benar
            }
            exit;
        }
    }

    // Metode edit dan saveEdit belum diimplementasikan, Anda bisa menambahkan fungsionalitas ini sesuai kebutuhan.
    static function edit() {}

    static function saveEdit() {}

    static function remove() {
        if (!isset($_SESSION['username'])) { // Menggunakan $_SESSION['username'] untuk memeriksa apakah pengguna sudah login
            header('Location: '.BASEURL.'login.php?auth=false'); // Mengubah BASEURL menjadi BASEURL.'login.php' untuk mengarahkan ke halaman login dengan benar
            exit;
        }
        else {
            $id = $_GET['id'];
            $sql = "DELETE FROM contact WHERE id_contact = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) { // Menggunakan affected_rows untuk memeriksa apakah data telah berhasil dihapus
                header('Location: '.BASEURL.'dashboard.php'); // Mengubah BASEURL menjadi BASEURL.'dashboard.php' untuk mengarahkan ke halaman dashboard dengan benar
            }
            else {
                header('Location: '.BASEURL.'dashboard.php?removeFailed=true'); // Mengubah BASEURL menjadi BASEURL.'dashboard.php' untuk mengarahkan kembali ke halaman dashboard dengan benar
            }
            exit;
        }
    }
}

?>
