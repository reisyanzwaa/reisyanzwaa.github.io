<?php
$host = 'localhost';
$dbname = 'lechaussee_db'; // Nama database yang benar
$username = 'root'; // Username default XAMPP
$password = ''; // Password default MySQL pada XAMPP biasanya kosong

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>
