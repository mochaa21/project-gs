<?php
include 'koneksi.php';

// --- PROSES SIMPAN DATA (JIKA TOMBOL DITEKAN) ---
if (isset($_POST['simpan'])) {
    $judul    = $_POST['judul'];
    $harga    = $_POST['harga'];
    $id_genre = $_POST['id_genre'];
    $id_dev   = $_POST['id_dev'];
    $id_pub   = $_POST['id_pub'];
    $id_req   = $_POST['id_req']; // Tambahan untuk System Req

    $query_simpan = "INSERT INTO games (judul, harga, id_genre, id_dev, id_pub, id_req) 
                     VALUES ('$judul', '$harga', '$id_genre', '$id_dev', '$id_pub', '$id_req')";
    
    if (mysqli_query($koneksi, $query_simpan)) {
        echo "<script>alert('Data Berhasil Disimpan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal Menyimpan: " . mysqli_error($koneksi) . "');</script>";
    }
}

// --- AMBIL DATA UNTUK DROPDOWN ---
$genres = mysqli_query($koneksi, "SELECT * FROM genres");
$devs   = mysqli_query($koneksi, "SELECT * FROM developers");
$pubs   = mysqli_query($koneksi, "SELECT * FROM publishers");
$reqs   = mysqli_query($koneksi, "SELECT * FROM sys_reqs"); // Ambil data spek
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Game - GameStore Admin</title>
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
            <small class="text-uppercase text-secondary fw-bold">Menu</small>
            <a href="index.php" class="mt-2"><i class="fas fa-arrow-left me-2"></i> Kembali ke List</a>
        </div>
    </div>

    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Tambah Game Baru</h2>

        <div class="card p-4">
            <form action="" method="POST">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Game</label>
                    <input type="text" name="judul" class="form-control" placeholder="Contoh: Minecraft" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Harga (IDR)</label>
                    <input type="number" name="harga" class="form-control" placeholder="Masukkan 0 jika gratis" required>
                    <div class="form-text">Gunakan angka saja tanpa titik (misal: 500000)</div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Genre</label>
                        <select name="id_genre" class="form-select" required>
                            <option value="">-- Pilih Genre --</option>
                            <?php while($g = mysqli_fetch_assoc($genres)): ?>
                                <option value="<?= $g['id_genre']; ?>"><?= $g['nama_genre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Spesifikasi PC</label>
                        <select name="id_req" class="form-select" required>
                            <option value="">-- Pilih Spek --</option>
                            <?php while($r = mysqli_fetch_assoc($reqs)): ?>
                                <option value="<?= $r['id_req']; ?>">
                                    <?= $r['os'] . " - " . $r['processor'] . " (RAM " . $r['ram_gb'] . "GB)"; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Developer</label>
                        <select name="id_dev" class="form-select" required>
                            <option value="">-- Pilih Developer --</option>
                            <?php while($d = mysqli_fetch_assoc($devs)): ?>
                                <option value="<?= $d['id_dev']; ?>"><?= $d['nama_dev']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Publisher</label>
                        <select name="id_pub" class="form-select" required>
                            <option value="">-- Pilih Publisher --</option>
                            <?php while($p = mysqli_fetch_assoc($pubs)): ?>
                                <option value="<?= $p['id_pub']; ?>"><?= $p['nama_pub']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" name="simpan" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i> Simpan Data</button>
                    <button type="reset" class="btn btn-secondary px-4">Reset</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>