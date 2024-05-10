<?php
// Lakukan koneksi ke database
$host = 'localhost';
$username = 'root';
$password = ''; // Ganti dengan password database Anda
$dbname = "contact app"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}