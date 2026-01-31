<?php
include 'koneksi.php';

// 1. Ambil ID dari URL
if (isset($_GET['id'])) {
    $id_beli = $_GET['id'];
    $query   = "SELECT * FROM trx_pembelian WHERE id_beli = '$id_beli'";
    $result  = mysqli_query($koneksi, $query);
    $data    = mysqli_fetch_assoc($result);

    if (!$data) {
        header("Location: trx_pembelian.php");
        exit;
    }
} else {
    header("Location: trx_pembelian.php");
    exit;
}

// 2. Proses Update Data
if (isset($_POST['update'])) {
    $no_invoice   = $_POST['no_invoice'];
    $id_user      = $_POST['id_user'];
    $tanggal_beli = $_POST['tanggal_beli'];
    $total_bayar  = $_POST['total_bayar'];

    $query_update = "UPDATE trx_pembelian SET 
                    no_invoice = '$no_invoice', 
                    id_user = '$id_user', 
                    tanggal_beli = '$tanggal_beli', 
                    total_bayar = '$total_bayar' 
                    WHERE id_beli = '$id_beli'";
    
    if (mysqli_query($koneksi, $query_update)) {
        echo "<script>
                alert('Transaksi Berhasil Diperbarui!'); 
                window.location='trx_pembelian.php';
              </script>";
    } else {
        echo "<script>alert('Gagal Update: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pembelian - GameStore Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, #212529 0%, #343a40 100%); color: white; }
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
        <h2 class="mb-4">Edit Transaksi Pembelian</h2>
        <div class="card p-4 shadow-sm" style="max-width: 600px;">
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nomor Invoice</label>
                    <input type="text" name="no_invoice" class="form-control" value="<?= $data['no_invoice']; ?>" required>
                </div>

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
                    <label class="form-label fw-bold">Tanggal Beli</label>
                    <input type="datetime-local" name="tanggal_beli" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($data['tanggal_beli'])); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Total Bayar (IDR)</label>
                    <input type="number" name="total_bayar" class="form-control" value="<?= $data['total_bayar']; ?>" required>
                </div>

                <div class="mt-4">
                    <button type="submit" name="update" class="btn btn-warning text-white px-4 shadow-sm">
                        <i class="fas fa-save me-2"></i> Perbarui Data
                    </button>
                    <a href="trx_pembelian.php" class="btn btn-light ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>