<?php
include 'koneksi.php';

// 1. Cek apakah ada ID di URL
if (isset($_GET['id'])) {
    $id_pub = $_GET['id'];

    // 2. Siapkan Query Hapus
    $query = "DELETE FROM publishers WHERE id_pub = '$id_pub'";

    // 3. Eksekusi Query
    if (mysqli_query($koneksi, $query)) {
        // JIKA SUKSES
        echo "<script>
                alert('Data Publisher Berhasil Dihapus!');
                window.location = 'publishers.php';
              </script>";
    } else {
        // JIKA GAGAL (Biasanya karena Foreign Key / Sedang dipakai di tabel Games)
        echo "<script>
                alert('GAGAL MENGHAPUS! Publisher ini sedang terhubung dengan data Game. Silakan hapus atau edit game yang terkait terlebih dahulu.');
                window.location = 'publishers.php';
              </script>";
    }
} else {
    // Jika akses tanpa ID, kembalikan ke list
    header("Location: publishers.php");
}
?>