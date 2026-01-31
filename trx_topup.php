<?php
include 'koneksi.php';

// SQL JOIN: Menghubungkan Topup dengan User dan Metode Pembayaran
$query = "SELECT t.*, u.username, p.nama_metode 
          FROM trx_topup t
          JOIN users u ON t.id_user = u.id_user
          JOIN payment_methods p ON t.id_pm = p.id_pm
          ORDER BY t.id_topup DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topup Wallet - GameStore Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, #212529 0%, #343a40 100%); color: white; width: 260px; }
        .sidebar a { color: #ced4da; text-decoration: none; display: block; padding: 12px 20px; transition: 0.3s; font-size: 0.9rem; }
        .sidebar a:hover { background-color: #495057; color: #fff; padding-left: 25px; }
        .sidebar a.active { background-color: #0d6efd; color: white; border-radius: 0 25px 25px 0; }
        .menu-label { font-size: 0.75rem; text-transform: uppercase; color: #6c757d; margin: 15px 20px 5px; font-weight: bold; }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="d-flex">
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-semibold">Riwayat Topup Wallet</h2>
            <a href="tambah_topup.php" class="btn btn-primary shadow-sm rounded-pill px-4">
                <i class="fas fa-plus-circle me-2"></i> Tambah Topup
            </a>
        </div>

        <div class="card p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Metode</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while($row = mysqli_fetch_assoc($result)) : 
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td class="fw-bold"><?= $row['username']; ?></td>
                            <td><span class="badge bg-info text-dark"><?= $row['nama_metode']; ?></span></td>
                            <td class="text-success fw-bold">Rp <?= number_format($row['jumlah'], 0, ',', '.'); ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($row['tanggal_topup'])); ?></td>
                            <td class="text-center">
                                <a href="edit_topup.php?id=<?= $row['id_topup']; ?>" class="btn btn-sm btn-warning text-white me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="hapus_topup.php?id=<?= $row['id_topup']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus riwayat topup ini?')">
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