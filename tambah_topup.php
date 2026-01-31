<?php
include 'koneksi.php';

// --- PROSES SIMPAN DATA ---
if (isset($_POST['simpan'])) {
    $id_user        = $_POST['id_user'];
    $id_pm          = $_POST['id_pm'];
    $jumlah         = $_POST['jumlah'];
    $tanggal_topup  = date('Y-m-d H:i:s');

    // Query Insert ke tabel trx_topup
    $query = "INSERT INTO trx_topup (id_user, id_pm, jumlah, tanggal_topup) 
              VALUES ('$id_user', '$id_pm', '$jumlah', '$tanggal_topup')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Topup Berhasil Diinput!'); 
                window.location='trx_topup.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal: " . mysqli_error($koneksi) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Topup - GameStore Admin</title>
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
                <i class="fas fa-arrow-left me-2"></i> Kembali ke List
            </a>
        </div>
    </div>

    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Input Topup Manual</h2>

        <div class="card p-4">
            <form action="" method="POST">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Pilih User</label>
                    <select name="id_user" class="form-select" required>
                        <option value="">-- Pilih User --</option>
                        <?php
                        $u = mysqli_query($koneksi, "SELECT id_user, username FROM users");
                        while($user = mysqli_fetch_assoc($u)) {
                            echo "<option value='".$user['id_user']."'>".$user['username']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Metode Pembayaran</label>
                    <select name="id_pm" class="form-select" required>
                        <option value="">-- Pilih Metode --</option>
                        <?php
                        $p = mysqli_query($koneksi, "SELECT id_pm, nama_metode FROM payment_methods");
                        while($pm = mysqli_fetch_assoc($p)) {
                            echo "<option value='".$pm['id_pm']."'>".$pm['nama_metode']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Jumlah Saldo (IDR)</label>
                    <input type="number" name="jumlah" class="form-control" placeholder="Contoh: 50000" required>
                </div>

                <div class="mt-4">
                    <button type="submit" name="simpan" class="btn btn-primary px-4">
                        <i class="fas fa-check-circle me-2"></i> Konfirmasi Topup
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>