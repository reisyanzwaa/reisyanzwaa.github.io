<?php
// Menampilkan semua error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Konfigurasi database
$db_host = 'localhost'; 
$db_username = 'root'; 
$db_password = ''; 
$db_name = 'lechaussee_db'; 

// Koneksi ke database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

?>
