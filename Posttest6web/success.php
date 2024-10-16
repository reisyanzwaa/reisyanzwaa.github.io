<?php
// success.php
require 'config.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $stmt = $pdo->prepare("SELECT nama, email FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        echo "<h1>Registrasi Berhasil!</h1>";
        echo "<p>Nama: " . htmlspecialchars($user['nama']) . "</p>";
        echo "<p>Email: " . htmlspecialchars($user['email']) . "</p>";
    } else {
        echo "<p>User tidak ditemukan.</p>";
    }
} else {
    echo "<p>Email tidak diberikan.</p>";
}
?>
