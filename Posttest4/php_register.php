<?php
session_start(); // Mulai sesi

// Memeriksa apakah semua data telah diisi
if (isset($_POST['nama']) && isset($_POST['email']) && isset($_POST['kataSandi']) && isset($_POST['konfirmasiKataSandi'])) {
    // Ambil data dari formulir
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $kataSandi = $_POST['kataSandi'];
    $konfirmasiKataSandi = $_POST['konfirmasiKataSandi'];
    $nomorTelepon = $_POST['nomorTelepon']; // Ambil nomor telepon dari input

    // Memeriksa apakah kata sandi dan konfirmasi kata sandi cocok
    if ($kataSandi === $konfirmasiKataSandi) {
        // Simpan data dalam sesi
        $_SESSION['nama'] = $nama;
        $_SESSION['email'] = $email;
        $_SESSION['nomorTelepon'] = $nomorTelepon;

        // Redirect ke halaman sukses
        header('Location: success.php');
        exit;
    } else {
        // Jika kata sandi tidak cocok, redirect kembali ke halaman registrasi
        header('Location: registrasi.html?error=password_mismatch');
        exit;
    }
} else {
    // Jika ada data yang tidak lengkap
    header('Location: registrasi.html?error=missing_data');
    exit;
}
?>
