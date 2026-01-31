<?php
include 'koneksi.php';

// Query Join Kompleks dengan Agregasi (SUM & COUNT)
$query = "SELECT 
            g.judul, 
            g.harga,
            COUNT(d.id_game) AS total_terjual, 
            SUM(d.harga_saat_beli) AS total_pendapatan
          FROM games g
          LEFT JOIN trx_pembelian_detail d ON g.id_game = d.id_game
          GROUP BY g.id_game
          ORDER BY total_terjual DESC";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan - GameStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background: #212529; color: white; width: 260px; }
        .sidebar a { color: #ced4da; text-decoration: none; display: block; padding: 12px 20px; }
        .card { border: none; border-radius: 10px; }
        @media print {
            .sidebar, .btn-print { display: none; }
            .flex-grow-1 { padding: 0 !important; }
        }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar p-3">
        <h4><i class="fas fa-gamepad text-primary"></i> GameStore</h4>
        <hr>
        <a href="index.php"><i class="fas fa-arrow-left me-2"></i> Dashboard</a>
    </div>

    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Laporan Penjualan Game</h2>
            <button onclick="window.print()" class="btn btn-success btn-print">
                <i class="fas fa-print me-2"></i> Cetak Laporan
            </button>
        </div>

        <div class="card p-4 shadow-sm">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul Game</th>
                        <th>Harga Satuan</th>
                        <th class="text-center">Jumlah Terjual</th>
                        <th class="text-end">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $grand_total = 0;
                    while($row = mysqli_fetch_assoc($result)) : 
                        $grand_total += $row['total_pendapatan'];
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td class="fw-bold"><?= $row['judul']; ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td class="text-center"><?= $row['total_terjual']; ?> x</td>
                        <td class="text-end fw-bold text-success">
                            Rp <?= number_format($row['total_pendapatan'], 0, ',', '.'); ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="4" class="text-end">GRAND TOTAL PENDAPATAN:</th>
                        <th class="text-end text-primary h5">
                            Rp <?= number_format($grand_total, 0, ',', '.'); ?>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

</body>
</html>