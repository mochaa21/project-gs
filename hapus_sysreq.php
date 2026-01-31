<?php
include 'koneksi.php';

// 1. Cek ID di URL
if (isset($_GET['id'])) {
    $id_req = $_GET['id'];

    // 2. Query Hapus
    $query = "DELETE FROM sys_reqs WHERE id_req = '$id_req'";

    // 3. Eksekusi Query
    if (mysqli_query($koneksi, $query)) {
        // JIKA SUKSES
        echo "<script>
                alert('Data Spesifikasi Berhasil Dihapus!');
                window.location = 'sysreqs.php';
              </script>";
    } else {
        // JIKA GAGAL (Karena Foreign Key masih dipakai di tabel Games)
        echo "<script>
                alert('GAGAL MENGHAPUS! Data spesifikasi ini masih digunakan oleh salah satu Game. Harap ubah spesifikasi pada game terkait terlebih dahulu.');
                window.location = 'sysreqs.php';
              </script>";
    }
} else {
    // Jika akses tanpa ID
    header("Location: sysreqs.php");
}
?>