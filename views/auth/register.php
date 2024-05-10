<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once __DIR__ . "/../../config/conn.php";
 // Ubah path ini sesuai dengan struktur direktori Anda

    // Tangkap data yang dikirimkan dari formulir HTML
    $nama = isset($_POST['reg-name']) ? $_POST['reg-name'] : '';
    $email = isset($_POST['reg-email']) ? $_POST['reg-email'] : '';
    $username_input = isset($_POST['reg-username']) ? $_POST['reg-username'] : '';
    $tgl_lahir = isset($_POST['reg-tgl_lahir']) ? $_POST['reg-tgl_lahir'] : '';
    $jns_kelamin = isset($_POST['reg-jns_kelamin']) ? $_POST['reg-jns_kelamin'] : '';
    $password = isset($_POST['reg-password']) ? $_POST['reg-password'] : '';
    $confirm_password = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';

    // Validasi konfirmasi password
    if ($password !== $confirm_password) {
        echo "Error: Konfirmasi password tidak cocok.";
        exit();
    }

    // Enkripsi password sebelum disimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO akun (nama, email, username, tgl_lahir, jns_kelamin, password) 
    VALUES ('$nama', '$email', '$username_input', '$tgl_lahir', '$jns_kelamin', '$hashed_password')";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Tutup koneksi database
        mysqli_close($conn);
        // Redirect to login page after successful registration
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Tutup koneksi database
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style_login_regiter.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="register-form">
                    <h2>Register</h2>
                    <form id="register-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="reg-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="reg-name" name="reg-name" required placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <label for="reg-no_hp" class="form-label">NO HP</label>
                            <input type="text" class="form-control" id="reg-no_hp" name="reg-no_hp" required placeholder="Nomor Handphone">
                        </div>
                        <!-- Tambahkan validasi email di sini -->
                        <div class="mb-3">
                            <label for="reg-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="reg-email" name="reg-email" required placeholder="Email@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="reg-username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="reg-username" name="reg-username" required placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <label for="reg-tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="reg-tgl_lahir" name="reg-tgl_lahir" required placeholder="Tanggal Lahir">
                        </div>
                        <div class="mb-3">
                            <label for="reg-jns_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="reg-jns_kelamin" name="reg-jns_kelamin" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>                        
                        <div class="mb-3">
                            <label for="reg-password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="reg-password" name="reg-password" required placeholder="Password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" required placeholder="Confirm Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                    <div class="mt-3">
                        <p>Already have an account?  <a href="../views/auth/login.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>
