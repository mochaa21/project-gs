<?php
include 'koneksi.php';

// 1. Cek apakah ada ID di URL
if (isset($_GET['id'])) {
    $id_topup = $_GET['id'];

    // 2. Query Hapus data topup
    $query = "DELETE FROM trx_topup WHERE id_topup = '$id_topup'";

    // 3. Eksekusi
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data riwayat topup berhasil dihapus!');
                window.location = 'trx_topup.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
                window.location = 'trx_topup.php';
              </script>";
    }
} else {
    // Jika tidak ada ID, kembalikan ke halaman utama topup
    header("Location: trx_topup.php");
}
?>