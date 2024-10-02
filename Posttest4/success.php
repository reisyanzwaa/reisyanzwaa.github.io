<?php
session_start(); // Memulai sesi untuk mengakses data yang disimpan

// Memeriksa apakah sesi email ada
if (isset($_SESSION['email'])) {
    // Menampilkan pesan selamat datang dan informasi pengguna
    echo "<h2>Registrasi berhasil!</h2>";
    echo "Selamat datang, " . htmlspecialchars($_SESSION['nama']) . "!";
    echo "<br>Email: " . htmlspecialchars($_SESSION['email']);
    echo "<br>Nomor Telepon: " . htmlspecialchars($_SESSION['nomorTelepon']); // Menampilkan nomor telepon
    echo "<br><a href='login.html'>Login di sini</a>";
    echo "<br><a href='logout.php'>Logout</a>"; // Link untuk logout jika ingin keluar
} else {
    echo "Tidak ada data pengguna.";
    echo "<br><a href='registrasi.html'>Kembali ke halaman registrasi</a>"; // Link kembali ke halaman registrasi
}
?>
