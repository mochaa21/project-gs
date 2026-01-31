<?php
include 'koneksi.php';

// 1. Cek ID
if (isset($_GET['id'])) {
    $id_dev = $_GET['id'];

    // 2. Query Hapus
    $query = "DELETE FROM developers WHERE id_dev = '$id_dev'";

    // 3. Eksekusi
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data Developer Berhasil Dihapus!');
                window.location = 'developers.php';
              </script>";
    } else {
        // Pesan Error Spesifik jika developer sedang dipakai di tabel Games
        echo "<script>
                alert('GAGAL MENGHAPUS! Developer ini sedang terdaftar pada salah satu Game. Hapus atau edit data game terkait terlebih dahulu.');
                window.location = 'developers.php';
              </script>";
    }
} else {
    header("Location: developers.php");
}
?>