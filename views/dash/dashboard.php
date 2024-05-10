<?php
include_once __DIR__ . "/../../config/conn.php";

// Fungsi untuk menampilkan data kontak
function loadContacts($conn) {
    // Perbaiki query SQL untuk memastikan tabel yang benar digunakan
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-nVw4nQhBmM9RnUTqpfewNnJKwd9zW0/UCfM8Y4rZLq9yy9JubkpGYtkbltW8wtVbT+ra8lW7L3VfJof5MpqxCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="sidebar">
                    <b><h2>Account</h2></b>
                    <div class="sidebar">
                        <div class="profile">
                            <img src="user.jpg" alt="User Profile">
                            <h3>Jagat Bahtera</h3>
                            <p>@bahtera</p>
                        </div>                                          
                    </div>                    
                </div>
            </div>
            <div class="col-md-9">
                <div class="dashboard">
                    <h2>Contact App Manager</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">NO HP</th>
                                <th scope="col">Owner</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="contact-list">
                            <!-- Data akan dimuat di sini melalui JavaScript -->
                            <?php
                            // Panggil fungsi untuk mendapatkan data kontak
                            $contacts = loadContacts($conn); // Load contacts from the database
                            foreach ($contacts as $contact) {
                                echo "<tr>";
                                echo "<td>" . $contact['id_contact'] . "</td>";
                                echo "<td>" . $contact['no_hp'] . "</td>";
                                echo "<td>" . $contact['nama'] . "</td>";
                                echo "<td>" . $contact['email'] . "</td>";
                                echo "<td>" . $contact['tgl_lahir'] . "</td>";
                                echo "<td>" . $contact['jns_kelamin'] . "</td>";
                                echo "<td>
                                <button id='editContact' class='btn btn-info btn-sm' onclick='editContact(\"" . $contact['id_contact'] . "\")'>Edit</button>
                                <button id= 'deleteContact' class='btn btn-danger btn-sm' onclick='deleteContact(\"" . $contact['id_contact'] . "\")'>Delete</button>
                                    </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" id="add-contact-btn">Add Contact</button>
                    <button class="btn btn-danger" id="logout-btn">Logout</button>
                </div>
            </div>
            <script>
                // Lakukan sesuatu saat tombol logout diklik, misalnya mengarahkan pengguna kembali ke halaman login
                document.getElementById("logout-btn").addEventListener("click", function () {
                    window.location.href = "../auth/login.php"; // Ganti "login.html" dengan URL halaman login yang sesuai
                });

                // Lakukan sesuatu saat tombol logout diklik, misalnya mengarahkan pengguna kembali ke halaman login
                document.getElementById("add-contact-btn").addEventListener("click", function () {
                    window.location.href = "../crud/add_contact.php"; // Ganti "login.html" dengan URL halaman login yang sesuai
                });
                
                document.getElementById("editContact").addEventListener("click", function () {
                // Ganti "edit_contact.php" dengan URL halaman edit contact yang sesuai
                window.location.href = "../crud/edit_contact.php?id=" + "<?php echo $contact['id_contact']; ?>";
                });

                document.getElementById("deleteContact").addEventListener("click", function () {
                // Ganti "edit_contact.php" dengan URL halaman edit contact yang sesuai
                window.location.href = "../crud/delete_contact.php?id=" + "<?php echo $contact['id_contact']; ?>";
                });



                
                </script>
            <div class="col-md-3">
                <div class="sidebar">
                    <b><ul>
                        <li><a href="#" class="active">Dashboard</a></li>
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#">Inbox<span class="inbox-message">5</span></a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Premium</a></li>
                        <li><a href="#">Setting</a></li>
                    </ul></b>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js"></script>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
