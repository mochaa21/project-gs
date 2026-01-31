<?php
include 'koneksi.php';

// 1. AMBIL ID DARI URL
if (isset($_GET['id'])) {
    $id_review = $_GET['id'];

    // Ambil data review lama
    $query  = "SELECT * FROM trx_review WHERE id_review = '$id_review'";
    $result = mysqli_query($koneksi, $query);
    $data   = mysqli_fetch_assoc($result);

    if (!$data) {
        header("Location: trx_review.php");
        exit;
    }
} else {
    header("Location: trx_review.php");
    exit;
}

// 2. PROSES UPDATE DATA
if (isset($_POST['update'])) {
    $id_user  = $_POST['id_user'];
    $id_game  = $_POST['id_game'];
    $rating   = $_POST['rating'];
    $komentar = $_POST['komentar'];

    $query_update = "UPDATE trx_review SET 
                    id_user = '$id_user', 
                    id_game = '$id_game', 
                    rating = '$rating', 
                    komentar = '$komentar' 
                    WHERE id_review = '$id_review'";
    
    if (mysqli_query($koneksi, $query_update)) {
        echo "<script>
                alert('Review Berhasil Diperbarui!'); 
                window.location='trx_review.php';
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
    <title>Edit Review - GameStore Admin</title>
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
            <a href="trx_review.php" class="mt-2 text-white">
                <i class="fas fa-times me-2"></i> Batal Edit
            </a>
        </div>
    </div>

    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Edit Ulasan User</h2>

        <div class="card p-4">
            <form action="" method="POST">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">User</label>
                    <select name="id_user" class="form-select" required>
                        <?php
                        $u = mysqli_query($koneksi, "SELECT id_user, username FROM users");
                        while($user = mysqli_fetch_assoc($u)) {
                            $selected = ($user['id_user'] == $data['id_user']) ? "selected" : "";
                            echo "<option value='".$user['id_user']."' $selected>".$user['username']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Game</label>
                    <select name="id_game" class="form-select" required>
                        <?php
                        $g = mysqli_query($koneksi, "SELECT id_game, judul FROM games");
                        while($game = mysqli_fetch_assoc($g)) {
                            $selected = ($game['id_game'] == $data['id_game']) ? "selected" : "";
                            echo "<option value='".$game['id_game']."' $selected>".$game['judul']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Rating</label>
                    <select name="rating" class="form-select" required>
                        <?php
                        $ratings = [5 => "5 - Sangat Bagus", 4 => "4 - Bagus", 3 => "3 - Cukup", 2 => "2 - Buruk", 1 => "1 - Sangat Buruk"];
                        foreach ($ratings as $val => $label) {
                            $selected = ($data['rating'] == $val) ? "selected" : "";
                            echo "<option value='$val' $selected>$label</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Komentar</label>
                    <textarea name="komentar" class="form-control" rows="4" required><?= $data['komentar']; ?></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" name="update" class="btn btn-warning text-white px-4">
                        <i class="fas fa-save me-2"></i> Update Review
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>