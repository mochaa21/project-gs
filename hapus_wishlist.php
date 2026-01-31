<?php
include 'koneksi.php';

// 1. Cek apakah ada ID di URL
if (isset($_GET['id'])) {
    $id_wishlist = $_GET['id'];

    // 2. Query Hapus data wishlist
    $query = "DELETE FROM trx_wishlist WHERE id_wishlist = '$id_wishlist'";

    // 3. Eksekusi
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data wishlist berhasil dihapus!');
                window.location = 'trx_wishlist.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
                window.location = 'trx_wishlist.php';
              </script>";
    }
} else {
    // Jika tidak ada ID, kembalikan ke halaman daftar wishlist
    header("Location: trx_wishlist.php");
}
?>