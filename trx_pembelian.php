<?php
include 'koneksi.php';

// SQL JOIN: Menggabungkan tabel transaksi dengan tabel user
$query = "SELECT trx_pembelian.*, users.username, users.email 
          FROM trx_pembelian 
          JOIN users ON trx_pembelian.id_user = users.id_user 
          ORDER BY trx_pembelian.tanggal_beli DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian - GameStore Admin</title>
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
        <a href="genres.php"><i class="fas fa-tags me-2 w-25"></i> Genres</a>
        <a href="payment.php"><i class="fas fa-wallet me-2 w-25"></i> Payment Methods</a>
        <a href="discounts.php"><i class="fas fa-percent me-2 w-25"></i> Discounts</a>
        <a href="sysreqs.php"><i class="fas fa-desktop me-2 w-25"></i> System Reqs</a>
        
        <div class="menu-label">Transaksi</div>
        <a href="trx_pembelian.php" class="active"><i class="fas fa-shopping-cart me-2 w-25"></i> Pembelian</a>
        <a href="trx_detail.php"><i class="fas fa-list me-2 w-25"></i> Detail Beli</a>
        <a href="trx_topup.php"><i class="fas fa-money-bill me-2 w-25"></i> Topup Wallet</a>
        <a href="trx_review.php"><i class="fas fa-star me-2 w-25"></i> Review User</a>
        <a href="trx_wishlist.php"><i class="fas fa-heart me-2 w-25"></i> Wishlist</a>
    </div>

    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Laporan Pembelian</h2>

        <div class="card p-4">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No Invoice</th>
                            <th>Username</th>
                            <th>Email Pembeli</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total Bayar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td class="fw-bold text-primary"><?= $row['no_invoice']; ?></td>
                            <td><?= $row['username']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= date('d M Y, H:i', strtotime($row['tanggal_beli'])); ?></td>
                            <td class="fw-bold text-success">
                                Rp <?= number_format($row['total_bayar'], 0, ',', '.'); ?>
                            </td>
                            <td class="text-center">
                                <a href="hapus_trx_beli.php?id=<?= $row['id_beli']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus riwayat transaksi ini?');">
                                    <i class="fas fa-trash"></i>
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