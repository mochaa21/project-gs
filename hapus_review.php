<?php
include 'koneksi.php';

// 1. Cek apakah ada ID di URL
if (isset($_GET['id'])) {
    $id_review = $_GET['id'];

    // 2. Query Hapus data review
    $query = "DELETE FROM trx_review WHERE id_review = '$id_review'";

    // 3. Eksekusi
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Ulasan pengguna berhasil dihapus!');
                window.location = 'trx_review.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus ulasan: " . mysqli_error($koneksi) . "');
                window.location = 'trx_review.php';
              </script>";
    }
} else {
    // Jika tidak ada ID, kembalikan ke halaman daftar review
    header("Location: trx_review.php");
}
?>