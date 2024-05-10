<?php
include_once __DIR__ . "/../../config/conn.php";

// Fungsi untuk menampilkan data kontak
function loadContacts($conn) {
    $sql = "SELECT * FROM contact";
    $result = $conn->query($sql);
    $contacts = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }
    }
    return $contacts;
}

// Proses penghapusan kontak
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Hapus data dari database
    $sql = "DELETE FROM contact WHERE id_contact = $id";
    if ($conn->query($sql) === TRUE) {
        // Redirect ke dashboard.php setelah penghapusan selesai
        header("Location: ../dash/dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
