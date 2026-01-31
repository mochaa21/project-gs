<?php
include 'koneksi.php';

// --- PROSES SIMPAN DATA ---
if (isset($_POST['simpan'])) {
    $no_invoice   = $_POST['no_invoice'];
    $id_user      = $_POST['id_user'];
    $tanggal_beli = $_POST['tanggal_beli'];
    $total_bayar  = $_POST['total_bayar'];

    // Query Insert ke tabel trx_pembelian
    $query = "INSERT INTO trx_pembelian (no_invoice, id_user, tanggal_beli, total_bayar) 
              VALUES ('$no_invoice', '$id_user', '$tanggal_beli', '$total_bayar')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Transaksi Berhasil Disimpan!'); 
                window.location='trx_pembelian.php';
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
    <title>Tambah Pembelian - GameStore Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background: #212529; color: white; width: 260px; }
        .sidebar a { color: #ced4da; text-decoration: none; display: block; padding: 12px 20px; }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar p-3">
        <h4><i class="fas fa-gamepad text-primary"></i> GameStore</h4>
        <hr>
        <a href="trx_pembelian.php"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
    </div>

    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Input Pembelian Baru</h2>
        <div class="card p-4">
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nomor Invoice</label>
                    <input type="text" name="no_invoice" class="form-control" placeholder="INV-XXXXX" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Pilih Pembeli (User)</label>
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
                    <label class="form-label fw-bold">Tanggal Transaksi</label>
                    <input type="datetime-local" name="tanggal_beli" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Total Bayar (Rp)</label>
                    <input type="number" name="total_bayar" class="form-control" required>
                </div>

                <button type="submit" name="simpan" class="btn btn-primary px-4">Simpan Transaksi</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>