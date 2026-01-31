<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_beli = $_GET['id'];
    $query   = "DELETE FROM trx_pembelian WHERE id_beli = '$id_beli'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data transaksi berhasil dihapus!');
                window.location = 'trx_pembelian.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus: " . mysqli_error($koneksi) . "');
                window.location = 'trx_pembelian.php';
              </script>";
    }
} else {
    header("Location: trx_pembelian.php");
}
?>