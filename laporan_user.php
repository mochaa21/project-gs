<?php
include 'koneksi.php';

// Query Join yang sudah disesuaikan dengan database game_store (2).sql
$query = "SELECT 
            u.username, 
            u.email, 
            u.saldo_wallet,
            COUNT(t.id_topup) AS frekuensi_topup, 
            SUM(t.jumlah_topup) AS total_topup_masuk
          FROM users u
          LEFT JOIN trx_topup t ON u.id_user = t.id_user
          GROUP BY u.id_user, u.username, u.email, u.saldo_wallet
          ORDER BY total_topup_masuk DESC";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aktivitas User - GameStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .badge-sultan { background-color: #ffd700; color: #000; font-weight: bold; padding: 5px 10px; border-radius: 5px; font-size: 0.7rem; }
        @media print {
            .sidebar, .btn-print { display: none !important; }
            .flex-grow-1 { padding: 0 !important; margin: 0 !important; }
        }
    </style>
</head>
<body>

<div class="d-flex">
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">Rekapitulasi Aktivitas Dana User</h2>
            <button onclick="window.print()" class="btn btn-primary rounded-pill px-4 btn-print shadow-sm">
                <i class="fas fa-print me-2"></i> Cetak Laporan
            </button>
        </div>

        <div class="card p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-3">No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th class="text-center">Frekuensi Topup</th>
                            <th class="text-end">Total Dana Masuk</th>
                            <th class="text-end pe-3">Saldo Wallet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while($row = mysqli_fetch_assoc($result)) : 
                            $total_masuk = $row['total_topup_masuk'] ?? 0;
                        ?>
                        <tr>
                            <td class="ps-3"><?= $no++; ?></td>
                            <td>
                                <span class="fw-bold"><?= $row['username']; ?></span>
                                <?php if($total_masuk > 500000) echo '<span class="badge-sultan ms-1">SULTAN</span>'; ?>
                            </td>
                            <td><?= $row['email']; ?></td>
                            <td class="text-center"><?= $row['frekuensi_topup']; ?> x</td>
                            <td class="text-end text-success fw-bold">
                                Rp <?= number_format($total_masuk, 0, ',', '.'); ?>
                            </td>
                            <td class="text-end pe-3 fw-bold">
                                Rp <?= number_format($row['saldo_wallet'], 0, ',', '.'); ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3">
            <small class="text-muted fst-italic">* Data laporan ini dihasilkan melalui penggabungan tabel `users` dan `trx_topup`.</small>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>