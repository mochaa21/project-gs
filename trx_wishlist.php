<?php
include 'koneksi.php';

// SQL JOIN: Menghubungkan Wishlist dengan data Game
$query = "SELECT w.*, g.judul, g.harga 
          FROM trx_wishlist w
          JOIN games g ON w.id_game = g.id_game
          ORDER BY w.id_wishlist DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Wishlist - GameStore Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, #212529 0%, #343a40 100%); color: white; }
        .sidebar .brand { padding: 20px; border-bottom: 1px solid #495057; }
        .sidebar a { color: #ced4da; text-decoration: none; display: block; padding: 12px 20px; transition: 0.3s; }
        .sidebar a:hover { background-color: #495057; color: #fff; padding-left: 25px; }
        .sidebar a.active { background-color: #0d6efd; color: white; border-radius: 0 25px 25px 0; }
        .menu-label { font-size: 0.75rem; text-transform: uppercase; color: #6c757d; margin: 15px 20px 5px; font-weight: bold; }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="d-flex">
    
    <div class="d-flex">
    <?php include 'sidebar.php'; ?>
    
    <div class="flex-grow-1 p-4">
        </div>
</div>

    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Daftar Wishlist Pengguna</h2>

        <div class="card p-4">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>Judul Game</th>
                            <th>Harga Saat Ini</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while($row = mysqli_fetch_assoc($result)) : 
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><span class="badge bg-secondary">User #<?= $row['id_user']; ?></span></td>
                            <td class="fw-bold"><?= $row['judul']; ?></td>
                            <td class="text-success fw-bold">
                                Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-clock me-1"></i> Menunggu Promo
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <p class="text-muted small">* Data ini menampilkan game yang paling banyak diinginkan oleh user untuk dianalisis sebagai bahan event diskon berikutnya.</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>