<?php
session_start();
session_destroy(); // Menghancurkan sesi
header('Location: login.html'); // Arahkan kembali ke halaman login
exit;
?>
