<?php
session_start();
require 'koneksi.php';

if (isset($_POST['masuk'])) {
    $email = $_POST['email'];
    $password = $_POST['kataSandi'];

    
    $sql = "SELECT * FROM users WHERE email = '$email' AND kata_sandi = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['email'] = true;
        echo "<script>alert('Login berhasil!');document.location.href = 'index.html';</script>";      
        exit;
    } else {
        $error_message = "Username atau password salah!";
        echo "<script>alert('$error_message');</script>";
    }

}

?>

