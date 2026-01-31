<?php
include 'koneksi.php';

// 1. CEK ID DI URL
if (isset($_GET['id'])) {
    $id_req = $_GET['id'];

    // Ambil data spesifikasi berdasarkan ID
    $query  = "SELECT * FROM sys_reqs WHERE id_req = '$id_req'";
    $result = mysqli_query($koneksi, $query);
    $data   = mysqli_fetch_assoc($result);

    // Jika data tidak ditemukan
    if (!$data) {
        header("Location: sysreqs.php");
        exit;
    }
} else {
    header("Location: sysreqs.php");
    exit;
}

// 2. PROSES UPDATE DATA
if (isset($_POST['update'])) {
    $os        = $_POST['os'];
    $processor = $_POST['processor'];
    $ram_gb    = $_POST['ram_gb'];
    $gpu       = $_POST['gpu'];

    // Query Update
    $query_update = "UPDATE sys_reqs SET 
                    os = '$os', 
                    processor = '$processor', 
                    ram_gb = '$ram_gb', 
                    gpu = '$gpu' 
                    WHERE id_req = '$id_req'";
    
    if (mysqli_query($koneksi, $query_update)) {
        echo "<script>
                alert('Spesifikasi Berhasil Diupdate!'); 
                window.location='sysreqs.php';
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
    <title>Edit SysReqs - GameStore Admin</title>
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
            <a href="sysreqs.php" class="mt-2 text-white">
                <i class="fas fa-times me-2"></i> Batal Edit
            </a>
        </div>
    </div>

    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Edit Spesifikasi Sistem</h2>

        <div class="card p-4">
            <form action="" method="POST">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Operating System (OS)</label>
                        <input type="text" name="os" class="form-control" value="<?= $data['os']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Processor</label>
                        <input type="text" name="processor" class="form-control" value="<?= $data['processor']; ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3