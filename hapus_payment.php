<?php
include 'koneksi.php';

// 1. Cek ID di URL
if (isset($_GET['id'])) {
    $id_pm = $_GET['id'];

    // 2. Siapkan Query Hapus
    $query = "DELETE FROM payment_methods WHERE id_pm = '$id_pm'";

    // 3. Eksekusi Query
    if (mysqli_query($koneksi, $query)) {
        // JIKA SUKSES
        echo "<script>
                alert('Metode Pembayaran Berhasil Dihapus!');
                window.location = 'payment.php';
              </script>";
    } else {
        // JIKA GAGAL (Karena sudah ada riwayat transaksi)
        echo "<script>
                alert('GAGAL MENGHAPUS! Metode pembayaran ini sudah tercatat dalam riwayat Topup User. Data tidak bisa dihapus demi keamanan laporan keuangan.');
                window.location = 'payment.php';
              </script>";
    }
} else {
    // Jika akses tanpa ID
    header("Location: payment.php");
}
?>