<?php
include 'koneksi.php';

// 1. AMBIL ID DARI URL
if (isset($_GET['id'])) {
    $id_topup = $_GET['id'];

    // Ambil data topup lama
    $query  = "SELECT * FROM trx_topup WHERE id_topup = '$id_topup'";
    $result = mysqli_query($koneksi, $query);
    $data   = mysqli_fetch_assoc($result);

    if (!$data) {
        header("Location: trx_topup.php");
        exit;
    }
} else {
    header("Location: trx_topup.php");
    exit;
}

// 2. PROSES UPDATE DATA
if (isset($_POST['update'])) {
    $id_user = $_POST['id_user'];
    $id_pm   = $_POST['id_pm'];
    $jumlah  = $_POST['jumlah'];

    $query_update = "UPDATE trx_topup SET 
                    id_user = '$id_user', 
                    id_pm = '$id_pm', 
                    jumlah = '$jumlah' 
                    WHERE id_topup = '$id_topup'";
    
    if (mysqli_query($koneksi, $query_update)) {
        echo "<script>
                alert('Data Topup Berhasil Diperbarui!'); 
                window.location='trx_topup.php';
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
    <title>Edit Topup - GameStore Admin</title>
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
            <a href="trx_topup.php" class="mt-2 text-white">
                <i class="fas fa-times me-2"></i> Batal Edit
            </a>
        </div>
    </div>

    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Koreksi Data Topup</h2>

        <div class="card p-4">
            <form action="" method="POST">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">User</label>
                    <select name="id_user" class="form-select" required>
                        <?php
                        $u = mysqli_query($koneksi, "SELECT id_user, username FROM users");
                        while($user = mysqli_fetch_assoc($u)) {
                            $selected = ($user['id_user'] == $data['id_user']) ? "selected" : "";
                            echo "<option value='".$user['id_user']."' $selected>".$user['username']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Metode Pembayaran</label>
                    <select name="id_pm" class="form-select" required>
                        <?php
                        $p = mysqli_query($koneksi, "SELECT id_pm, nama_metode FROM payment_methods");
                        while($pm = mysqli_fetch_assoc($p)) {
                            $selected = ($pm['id_pm'] == $data['id_pm']) ? "selected" : "";
                            echo "<option value='".$pm['id_pm']."' $selected>".$pm['nama_metode']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Jumlah Saldo (IDR)</label>
                    <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah']; ?>" required>
                </div>

                <div class="mt-4">
                    <button type="submit" name="update" class="btn btn-warning text-white px-4">
                        <i class="fas fa-save me-2"></i> Update Data Topup
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>