<?php
include 'koneksi.php';

// Query Join untuk menghitung total topup per user
$query = "SELECT 
            u.username, 
            u.email, 
            u.wallet_balance,
            COUNT(t.id_topup) AS frekuensi_topup, 
            SUM(t.jumlah) AS total_topup_masuk
          FROM users u
          LEFT JOIN trx_topup t ON u.id_user = t.id_user
          GROUP BY u.id_user
          ORDER BY total_topup_masuk DESC";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Aktivitas User - GameStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background: #212529; color: white; width: 260px; }
        .sidebar a { color: #ced4da; text-decoration: none; display: block; padding: 12px 20px; }
        .card { border: none; border-radius: 10px; }
        .badge-sultan { background-color: #ffd700; color: #000; font-weight: bold; }
        @media print {
            .sidebar, .btn-print, .nav-back { display: none; }
            .flex-grow-1 { padding: 0 !important; }
        }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar p-3 nav-back">
        <h4><i class="fas fa-gamepad text-primary"></i> GameStore</h4>
        <hr>
        <a href="index.php"><i class="fas fa-arrow-left me-2"></i> Dashboard</a>
        <a href="laporan_penjualan.php"><i class="fas fa-chart-line me-2"></i> Laporan Penjualan</a>
    </div>

    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Laporan Aktivitas Dompet User</h2>
                <p class="text-muted">Rekapitulasi total pengisian saldo (Topup) per pelanggan.</p>
            </div>
            <button onclick="window.print()" class="btn btn-primary btn-print">
                <i class="fas fa-print me-2"></i> Cetak Laporan
            </button>
        </div>

        <div class="card p-4 shadow-sm">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th class="text-center">Frekuensi Topup</th>
                        <th class="text-end">Total Topup Masuk</th>
                        <th class="text-end">Saldo Saat Ini</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($result)) : 
                        $total_masuk = $row['total_topup_masuk'] ?? 0;
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <span class="fw-bold"><?= $row['username']; ?></span>
                            <?php if($total_masuk > 500000) echo '<span class="badge badge-sultan ms-1">SULTAN</span>'; ?>
                        </td>
                        <td><?= $row['email']; ?></td>
                        <td class="text-center"><?= $row['frekuensi_topup']; ?> x</td>
                        <td class="text-end text-success fw-bold">
                            Rp <?= number_format($total_masuk, 0, ',', '.'); ?>
                        </td>
                        <td class="text-end fw-bold">
                            Rp <?= number_format($row['wallet_balance'], 0, ',', '.'); ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 p-3 bg-white border-start border-primary border-4 shadow-sm">
            <small class="text-muted">
                <strong>Informasi:</strong> User dengan label <span class="badge badge-sultan">SULTAN</span> adalah user dengan total akumulasi topup di atas Rp 500.000.
            </small>
        </div>
    </div>
</div>

</body>
</html>