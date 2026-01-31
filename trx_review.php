<?php
include 'koneksi.php';

// SQL JOIN: Menghubungkan Review dengan User dan Game (Syarat UAS)
$query = "SELECT r.*, u.username, g.judul 
          FROM trx_review r
          JOIN users u ON r.id_user = u.id_user
          JOIN games g ON r.id_game = g.id_game
          ORDER BY r.id_review DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review User - GameStore Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .star-rating { color: #ffc107; }
    </style>
</head>
<body>

<div class="d-flex">
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Review & Ulasan User</h2>
            <a href="tambah_review.php" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-plus-circle me-2"></i> Tambah Review
            </a>
        </div>

        <div class="card p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Game</th>
                            <th>Rating</th>
                            <th>Ulasan</th>
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
                            <td><?= $row['judul']; ?></td>
                            <td>
                                <span class="star-rating">
                                    <?php 
                                    for($i=1; $i<=5; $i++) {
                                        echo $i <= $row['rating'] ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                                    }
                                    ?>
                                </span>
                            </td>
                            <td><small class="text-muted"><?= substr($row['ulasan'], 0, 50); ?>...</small></td>
                            <td class="text-center">
                                <a href="edit_review.php?id=<?= $row['id_review']; ?>" class="btn btn-sm btn-warning text-white me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="hapus_review.php?id=<?= $row['id_review']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus review ini?')">
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