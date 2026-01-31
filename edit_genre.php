<?php
include 'koneksi.php';

// 1. CEK APAKAH ADA ID DI URL
if (isset($_GET['id'])) {
    $id_genre = $_GET['id'];

    // Ambil data genre yang mau diedit
    $query  = "SELECT * FROM genres WHERE id_genre = '$id_genre'";
    $result = mysqli_query($koneksi, $query);
    $data   = mysqli_fetch_assoc($result);

    // Kalau ID-nya ngawur (tidak ada di database), kembalikan ke list
    if (!$data) {
        header("Location: genres.php");
        exit;
    }
} else {
    header("Location: genres.php");
    exit;
}

// 2. PROSES UPDATE DATA
if (isset($_POST['update'])) {
    $nama_genre = $_POST['nama_genre'];

    // Query Update
    $query_update = "UPDATE genres SET nama_genre = '$nama_genre' WHERE id_genre = '$id_genre'";
    
    if (mysqli_query($koneksi, $query_update)) {
        echo "<script>
                alert('Nama Genre Berhasil Diupdate!'); 
                window.location='genres.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal Update: " . mysqli_error($koneksi) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Genre - GameStore Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, #212529 0%, #343a40 100%); color: white; }
        .sidebar a { color: #ced4da; text-decoration: none; display: block; padding: 12px 20px; transition: 0.3s; }
        .sidebar a:hover { background-color: #495057; color: #fff; padding-left: 25px; }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="d-flex">
    
    <div class="sidebar" style="width: 260px; flex-shrink: 0;">
        <div class="p-4 border-bottom border-secondary">
            <h4><i class="fas fa-gamepad text-primary"></i> GameStore</h4>
        </div>
        <div class="p-3">
            <small class="text-uppercase text-secondary fw-bold">Navigasi</small>
            <a href="genres.php" class="mt-2 text-white">
                <i class="fas fa-times me-2"></i> Batal Edit
            </a>
        </div>
    </div>

    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Edit Nama Genre</h2>

        <div class="card p-4">
            <form action="" method="POST">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Genre</label>
                    <input type="text" name="nama_genre" class="form-control" value="<?= $data['nama_genre']; ?>" required>
                </div>

                <div class="mt-4">
                    <button type="submit" name="update" class="btn btn-warning text-white px-4">
                        <i class="fas fa-save me-2"></i> Update Genre
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>