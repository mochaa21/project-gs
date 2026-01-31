<?php
include 'koneksi.php';

// SQL JOIN 3 Tabel: Detail, Games, dan Pembelian (Invoice)
$query = "SELECT d.*, g.judul, p.no_invoice 
          FROM trx_pembelian_detail d
          JOIN games g ON d.id_game = g.id_game
          JOIN trx_pembelian p ON d.id_beli = p.id_beli
          ORDER BY d.id_detail DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelian - GameStore Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="d-flex">
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Detail Item Pembelian</h2>
            <a href="tambah_detail.php" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-plus-circle me-2"></i> Tambah Detail
            </a>
        </div>

        <div class="card p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>No Invoice</th>
                            <th>Judul Game</th>
                            <th>Harga Satuan</th>
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
                            <td class="fw-bold text-primary"><?= $row['no_invoice']; ?></td>
                            <td><?= $row['judul']; ?></td>
                            <td class="text-success fw-bold">
                                Rp <?= number_format($row['harga_saat_beli'], 0, ',', '.'); ?>
                            </td>
                            <td class="text-center">
                                <a href="edit_detail.php?id=<?= $row['id_detail']; ?>" class="btn btn-sm btn-warning text-white me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="hapus_detail.php?id=<?= $row['id_detail']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus detail item ini?')">
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