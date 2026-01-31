<?php
include 'koneksi.php';

// 1. CEK ID DI URL (PENTING!)
// Kita harus tahu user mana yang mau diedit berdasarkan ?id=...
if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // Ambil data user dari database berdasarkan ID tersebut
    $query  = "SELECT * FROM users WHERE id_user = '$id_user'";
    $result = mysqli_query($koneksi, $query);
    $data   = mysqli_fetch_assoc($result);

    // Jika user tidak ditemukan (misal ID ngawur), kembalikan ke list
    if (!$data) {
        header("Location: users.php");
        exit;
    }
} else {
    // Jika tidak ada ID di URL, tendang balik ke users.php
    header("Location: users.php");
    exit;
}

// 2. PROSES UPDATE DATA
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $region   = $_POST['region'];
    $saldo    = $_POST['saldo_wallet'];

    // Query Update
    $query_update = "UPDATE users SET 
                     username = '$username', 
                     email = '$email', 
                     region = '$region', 
                     saldo_wallet = '$saldo' 
                     WHERE id_user = '$id_user'";
    
    if (mysqli_query($koneksi, $query_update)) {
        echo "<script>
                alert('Data User Berhasil Diupdate!'); 
                window.location='users.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal Update: " . mysqli_error($koneksi) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - GameStore Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, #212529 0%, #343a40 100%); color: white; }
        .sidebar a { color: #ced4da; text-decoration: none; display: block; padding: 12px 20px; transition: 0.3s; }
        .sidebar a:hover { background-color: #495057; color: #fff; padding-left: 25px; }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="d-flex">
    
    <div class="sidebar" style="width: 260px; flex-shrink: 0;">
        <div class="p-4 border-bottom border-secondary">
            <h4><i class="fas fa-gamepad text-primary"></i> GameStore</h4>
        </div>
        <div class="p-3">
            <small class="text-uppercase text-secondary fw-bold">Navigasi</small>
            <a href="users.php" class="mt-2 text-white">
                <i class="fas fa-times me-2"></i> Batal Edit
            </a>
        </div>
    </div>

    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Edit Data User</h2>

        <div class="card p-4">
            <form action="" method="POST">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $data['username']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $data['email']; ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Region (Wilayah)</label>
                        <select name="region" class="form-select" required>
                            <option value="ID" <?= ($data['region'] == 'ID') ? 'selected' : ''; ?>>ID - Indonesia</option>
                            <option value="US" <?= ($data['region'] == 'US') ? 'selected' : ''; ?>>US - United States</option>
                            <option value="SG" <?= ($data['region'] == 'SG') ? 'selected' : ''; ?>>SG - Singapore</option>
                            <option value="JP" <?= ($data['region'] == 'JP') ? 'selected' : ''; ?>>JP - Japan</option>
                            <option value="UK" <?= ($data['region'] == 'UK') ? 'selected' : ''; ?>>UK - United Kingdom</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Saldo Wallet (IDR)</label>
                        <input type="number" name="saldo_wallet" class="form-control" value="<?= $data['saldo_wallet']; ?>" required>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" name="update" class="btn btn-warning text-white px-4">
                        <i class="fas fa-save me-2"></i> Update Data
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>