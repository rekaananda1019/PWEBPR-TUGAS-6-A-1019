<?php
include_once __DIR__ . "/../../config/conn.php";

// Ambil data dari formulir tambah kontak
$no_hp = $_POST['no_hp'];
$owner = $_POST['owner'];
$email = $_POST['email'];
$tgl_lahir = $_POST['tgl_lahir'];
$jns_kelamin = isset($_POST['jns_kelamin']) ? $_POST['jns_kelamin'] : '';

// Buat query SQL untuk menyimpan data kontak ke database
$sql = "INSERT INTO contact (no_hp, nama, email, tgl_lahir, jns_kelamin) VALUES ('$no_hp', '$owner', '$email', '$tgl_lahir', '$jns_kelamin')";

// Eksekusi query SQL
if ($conn->query($sql) === TRUE) {
    // Redirect kembali ke halaman dashboard setelah berhasil menyimpan
    header("Location: ../dash/dashboard.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
