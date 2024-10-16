<?php
require "koneksi.php";

$id = $_GET['id'];
$sql = "DELETE FROM mhs WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Data mahasiswa berhasil dihapus!'); window.location.href = 'CRUDAdmin.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data mahasiswa!'); window.location.href = 'CRUDAdmin.php';</script>";
}
?>
