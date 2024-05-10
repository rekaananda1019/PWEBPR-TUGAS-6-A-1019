<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Add Contact</h2>
        <form method="POST" action="save_contact.php">
            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
            </div>
            <div class="mb-3">
                <label for="owner" class="form-label">Owner</label>
                <input type="text" class="form-control" id="owner" name="owner" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
            </div>
            <div class="mb-3">
                            <label for="reg-jns_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="reg-jns_kelamin" name="reg-jns_kelamin" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</body>
</html>
