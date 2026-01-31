<?php
include 'koneksi.php';

// 1. Cek ID di URL
if (isset($_GET['id'])) {
    $id_diskon = $_GET['id'];

    // 2. Query Hapus
    $query = "DELETE FROM discounts WHERE id_diskon = '$id_diskon'";

    // 3. Eksekusi
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Event Diskon Berhasil Dihapus!');
                window.location = 'discounts.php';
              </script>";
    } else {
        // Error jika diskon masih terikat dengan detail pembelian atau game
        echo "<script>
                alert('GAGAL MENGHAPUS! Diskon ini masih tercatat dalam riwayat transaksi atau sedang digunakan pada data game.');
                window.location = 'discounts.php';
              </script>";
    }
} else {
    header("Location: discounts.php");
}
?>