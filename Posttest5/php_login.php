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

// Cek apakah permintaan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari request
    $data = json_decode(file_get_contents("php://input"), true);

    // Debugging: Tampilkan data yang diterima
    var_dump($data);
    die();

    // Mengambil nilai input
    $email = $data['email'];
    $kata_sandi = $data['kataSandi'];
    $nomor_telepon = $data['nomorTelepon'];

    // Menghindari SQL Injection
    $email = $conn->real_escape_string($email);
    $nomor_telepon = $conn->real_escape_string($nomor_telepon);

    // Query untuk mengambil data pengguna berdasarkan email dan nomor telepon
    $query = "SELECT * FROM users WHERE email = '$email' AND nomor_telepon = '$nomor_telepon'";
    $result = $conn->query($query);

    // Debugging: Cek apakah query berhasil
    if (!$result) {
        echo "Query Error: " . $conn->error;
        die();
    }

    if ($result->num_rows > 0) {
        // Mengambil data pengguna
        $user_data = $result->fetch_assoc();

        // Verifikasi kata sandi
        if (password_verify($kata_sandi, $user_data['kata_sandi'])) {
            session_start();
            $_SESSION['user_id'] = $user_data['id']; 

            echo json_encode(array('success' => true, 'message' => 'Login berhasil!'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Kata sandi salah.'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Email atau nomor telepon tidak ditemukan.'));
    }
}

$conn->close();
?>
