<?php
include_once __DIR__ . "/../../config/conn.php";

// Ambil semua data kontak dari database
$sql = "SELECT * FROM contact";
$result = $conn->query($sql);

// Lakukan loop untuk menampilkan formulir pengeditan untuk setiap kontak
while($contactData = $result->fetch_assoc()) {
    ?>
    <!-- Tampilkan formulir untuk mengedit data kontak -->
    <form action="update_contact.php" method="POST">
        <input type="hidden" name="contact_id" value="<?php echo $contactData['id_contact']; ?>">
        <!-- Tambahkan input untuk setiap kolom data kontak -->
        <input type="text" name="no_hp" value="<?php echo $contactData['no_hp']; ?>">
        <input type="text" name="owner" value="<?php echo $contactData['nama']; ?>">
        <input type="text" name="email" value="<?php echo $contactData['email']; ?>">
        <input type="text" name="tgl_lahir" value="<?php echo $contactData['tgl_lahir']; ?>">
        <select name="jns_kelamin">
            <option value="male" <?php if($contactData['jns_kelamin'] == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if($contactData['jns_kelamin'] == 'female') echo 'selected'; ?>>Female</option>
        </select>
        <button type="submit">Simpan Perubahan</button>
    </form>
    <?php
}
?>
