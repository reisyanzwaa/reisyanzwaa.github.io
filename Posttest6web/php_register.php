<?php
include 'koneksi.php'; // Make sure this file contains the correct database connection code

if (isset($_POST["daftar"])) { // Check if the form is submitted
    // Retrieve form data
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pw = $_POST['kataSandi'];

   $sql = "INSERT INTO users (nama_lengkap, email, kata_sandi) VALUES ('$nama', '$email', '$$pw')";

   if($conn->query($sql)) {
    echo "<script>alert('Berhasil');
    location.href = 'login.html';
    </script>";
   }
}
?>
