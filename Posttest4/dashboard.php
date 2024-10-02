<?php
session_start(); // Memulai sesi untuk mengakses data yang disimpan

// Memeriksa apakah sesi email ada
if (isset($_SESSION['email'])) {
    // Menampilkan pesan selamat datang dan informasi pengguna
    echo "<h2>Selamat datang di Dashboard!</h2>";
    echo "Selamat datang, " . htmlspecialchars($_SESSION['nama']) . "!";
    echo "<br>Email: " . htmlspecialchars($_SESSION['email']);
    echo "<br><a href='logout.php'>Logout</a>"; // Link untuk logout jika ingin keluar
} else {
    // Jika tidak ada data pengguna, arahkan kembali ke halaman login
    header('Location: login.html');
    exit;
}
?>
