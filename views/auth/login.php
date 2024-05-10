<?php
session_start(); // Mulai sesi
include_once __DIR__ . "/../../config/conn.php";

// Mendapatkan nilai input username dan password dari form
$input_username = $_POST['username'] ?? '';
$input_password = $_POST['password'] ?? '';

// Prepared Statement untuk mencegah SQL Injection
$sql = "SELECT * FROM akun WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $input_username, $input_password); // Bind values securely
$stmt->execute();
$result = $stmt->get_result();

// Memeriksa apakah hasil query mengembalikan baris atau tidak
if ($result->num_rows == 1) {
    // Jika ada hasil, berarti login berhasil
    $_SESSION['username'] = $input_username; // Simpan username di sesi
    header("Location: ../dash/dashboard.php"); // Arahkan ke dashboard
    exit();
} else {
    // Jika tidak ada hasil, berarti login gagal
    $error_message = "Username atau password Anda salah!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style_login_regiter.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="login-form">
                    <h2>Login</h2>
                    <?php if (isset($error_message)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php } ?>
                    <form id="login-form" action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required placeholder="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="password">
                        </div>
                        <button type="submit" id="loginButton" class="btn btn-primary">Login</button>
                    </form>
                    <div class="mt-3">
                        <p>Don't have an account? <a href="register.php">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
