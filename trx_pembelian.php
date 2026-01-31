<?php
include 'koneksi.php';

// Query JOIN untuk menampilkan Nama User (Syarat UAS Laporan Join)
$query = "SELECT trx_pembelian.*, users.username 
          FROM trx_pembelian 
          JOIN users ON trx_pembelian.id_user = users.id_user 
          ORDER BY trx_pembelian.id_beli DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian - GameStore Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .table thead { background-color: #212529; color: white; }
    </style>
</head>
<body>

<div class="d-flex">
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Riwayat Pembelian</h2>
            <a href="tambah_pembelian.php" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-plus-circle me-2"></i> Tambah Transaksi
            </a>
        </div>

        <div class="card p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="py-3">No Invoice</th>
                            <th>Username</th>
                            <th>Tanggal Beli</th>
                            <th>Total Bayar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td class="fw-bold text-primary"><?= $row['no_invoice']; ?></td>
                            <td><?= $row['username']; ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($row['tanggal_beli'])); ?></td>
                            <td class="fw-bold text-success">
                                Rp <?= number_format($row['total_bayar'], 0, ',', '.'); ?>
                            </td>
                            <td class="text-center">
                                <a href="edit_pembelian.php?id=<?= $row['id_beli']; ?>" class="btn btn-sm btn-warning text-white me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="hapus_pembelian.php?id=<?= $row['id_beli']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
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