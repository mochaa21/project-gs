<?php
include 'koneksi.php';

// 1. Cek apakah ada ID di URL
if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // 2. Siapkan Query Hapus
    $query = "DELETE FROM users WHERE id_user = '$id_user'";

    // 3. Eksekusi Query dengan Pengecekan Error
    if (mysqli_query($koneksi, $query)) {
        // JIKA SUKSES
        echo "<script>
                alert('Data User Berhasil Dihapus!');
                window.location = 'users.php';
              </script>";
    } else {
        // JIKA GAGAL (Biasanya karena Foreign Key / Ada Riwayat Transaksi)
        echo "<script>
                alert('GAGAL MENGHAPUS! User ini memiliki riwayat transaksi (Topup/Pembelian). Data transaksi harus dihapus terlebih dahulu sebelum menghapus user ini.');
                window.location = 'users.php';
              </script>";
    }
} else {
    // Jika orang iseng buka file ini tanpa ID, kembalikan ke index
    header("Location: users.php");
}

?>