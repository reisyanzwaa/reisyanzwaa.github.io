<?php
session_start(); // Memulai sesi untuk mengakses data yang disimpan

// Memeriksa apakah form login sudah di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari formulir login
    $email = $_POST['email'];
    $kataSandi = $_POST['kataSandi'];

    // Memeriksa apakah sesi email dan kata sandi ada
    if (isset($_SESSION['email']) && isset($_SESSION['kataSandi'])) {
        // Validasi email dan kata sandi
        if ($email === $_SESSION['email'] && $kataSandi === $_SESSION['kataSandi']) {
            // Jika cocok, redirect ke halaman dashboard
            // Redirect ke halaman sukses
            header('Location: dashboard.php'); // Pastikan nama file ini benar
            exit;
        } else {
            // Jika tidak cocok, arahkan kembali ke halaman login dengan pesan error
            header('Location: login.html?error=invalid_credentials');
            exit;
        }
    } else {
        // Jika tidak ada sesi yang ditemukan, redirect ke halaman login
        header('Location: login.html?error=session_not_found');
        exit;
    }
} else {
    // Jika bukan metode POST, redirect ke halaman login
    header('Location: login.html');
    exit;
}
?>
