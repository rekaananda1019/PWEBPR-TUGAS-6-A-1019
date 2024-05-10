<?php
include_once __DIR__ . "/../../config/conn.php";

// Periksa apakah data yang dibutuhkan telah dikirimkan
if(isset($_POST['contact_id'], $_POST['no_hp'], $_POST['owner'], $_POST['email'], $_POST['tgl_lahir'], $_POST['jns_kelamin'])) {
    // Ambil data yang dikirimkan dari formulir
    $contactId = $_POST['contact_id'];
    $noHp = $_POST['no_hp'];
    $owner = $_POST['owner'];
    $email = $_POST['email'];
    $tglLahir = $_POST['tgl_lahir'];
    $jnsKelamin = $_POST['jns_kelamin'];

    // Lakukan query untuk memperbarui data kontak
    $sql = "UPDATE contact SET no_hp='$noHp', nama='$owner', email='$email', tgl_lahir='$tglLahir', jns_kelamin='$jnsKelamin' WHERE id_contact=$contactId";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman dashboard setelah pembaruan berhasil
        header("Location: ../dash/dashboard.php");
        exit(); // Pastikan untuk keluar dari skrip setelah melakukan redirect
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Data yang diperlukan tidak lengkap.";
}

$conn->close();
?>
