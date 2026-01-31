<?php
include 'koneksi.php';

// --- PROSES SIMPAN DATA ---
if (isset($_POST['simpan'])) {
    $nama_metode = $_POST['nama_metode'];
    $biaya_admin = $_POST['biaya_admin'];

    // Query Insert
    $query = "INSERT INTO payment_methods (nama_metode, biaya_admin) VALUES ('$nama_metode', '$biaya_admin')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Metode Pembayaran Berhasil Ditambahkan!'); 
                window.location='payment.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal Menyimpan: " . mysqli_error($koneksi) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Payment Method - GameStore Admin</title>
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
            <a href="payment.php" class="mt-2 text-white">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke List
            </a>
        </div>
    </div>

    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Tambah Metode Pembayaran</h2>

        <div class="card p-4">
            <form action="" method="POST">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Metode</label>
                    <input type="text" name="nama_metode" class="form-control" placeholder="Contoh: GoPay, OVO, Dana" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Biaya Admin (IDR)</label>
                    <input type="number" name="biaya_admin" class="form-control" placeholder="0" required>
                    <div class="form-text">Masukkan angka saja tanpa titik (misal: 1000)</div>
                </div>

                <div class="mt-4">
                    <button type="submit" name="simpan" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i> Simpan Metode
                    </button>
                    <button type="reset" class="btn btn-secondary px-4">Reset</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>