<?php
include 'koneksi.php';

// Ambil data genres, urutkan berdasarkan ID
$query = "SELECT * FROM genres ORDER BY id_genre ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Genres - GameStore</title>
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
    
    <div class="sidebar" style="width: 260px; flex-shrink: 0;">
        <div class="brand text-center">
            <h4><i class="fas fa-gamepad text-primary"></i> GameStore</h4>
            <small>Admin Dashboard</small>
        </div>

        <div class="menu-label">Master Data</div>
        <a href="index.php"><i class="fas fa-compact-disc me-2 w-25"></i> Games</a>
        <a href="users.php"><i class="fas fa-users me-2 w-25"></i> Users</a>
        <a href="developers.php"><i class="fas fa-code me-2 w-25"></i> Developers</a>
        <a href="publishers.php"><i class="fas fa-building me-2 w-25"></i> Publishers</a>
        <a href="genres.php" class="active"><i class="fas fa-tags me-2 w-25"></i> Genres</a>
        <a href="payment.php"><i class="fas fa-wallet me-2 w-25"></i> Payment Methods</a>
        <a href="discounts.php"><i class="fas fa-percent me-2 w-25"></i> Discounts</a>
        <a href="sysreqs.php"><i class="fas fa-desktop me-2 w-25"></i> System Reqs</a>

        <div class="menu-label">Transaksi</div>
        <a href="trx_pembelian.php"><i class="fas fa-shopping-cart me-2 w-25"></i> Pembelian</a>
        <a href="trx_detail.php"><i class="fas fa-list me-2 w-25"></i> Detail Beli</a>
        <a href="trx_topup.php"><i class="fas fa-money-bill me-2 w-25"></i> Topup Wallet</a>
        <a href="trx_review.php"><i class="fas fa-star me-2 w-25"></i> Review User</a>
        <a href="trx_wishlist.php"><i class="fas fa-heart me-2 w-25"></i> Wishlist</a>
    </div>

    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Data Kategori Genre</h2>

        <div class="card p-4">
            <div class="mb-3">
                <a href="tambah_genre.php" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Genre Baru
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 10%;">No / ID</th>
                            <th>Nama Genre</th>
                            <th class="text-center" style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td>#<?= $row['id_genre']; ?></td>
                            <td class="fw-bold"><?= $row['nama_genre']; ?></td>
                            
                            <td class="text-center">
                                <a href="edit_genre.php?id=<?= $row['id_genre']; ?>" class="btn btn-sm btn-warning text-white">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="hapus_genre.php?id=<?= $row['id_genre']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus genre ini?');">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>