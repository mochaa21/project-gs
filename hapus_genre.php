<?php
include 'koneksi.php';

// 1. Cek ID di URL
if (isset($_GET['id'])) {
    $id_genre = $_GET['id'];

    // 2. Query Hapus
    $query = "DELETE FROM genres WHERE id_genre = '$id_genre'";

    // 3. Eksekusi dengan Validasi Error
    if (mysqli_query($koneksi, $query)) {
        // Jika Sukses (Genre tidak sedang dipakai game manapun)
        echo "<script>
                alert('Genre Berhasil Dihapus!');
                window.location = 'genres.php';
              </script>";
    } else {
        // Jika Gagal (Biasanya karena dipakai di tabel Games)
        echo "<script>
                alert('GAGAL MENGHAPUS! Genre ini sedang digunakan oleh data Game. Hapus atau ubah dulu genre pada game yang terkait.');
                window.location = 'genres.php';
              </script>";
    }
} else {
    // Jika akses tanpa ID
    header("Location: genres.php");
}
?>