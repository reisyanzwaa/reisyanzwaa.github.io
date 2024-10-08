<?php
// Koneksi database
$db_host = 'localhost'; 
$db_username = 'root'; 
$db_password = ''; 
$db_name = 'lechaussee_db'; 

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah permintaan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari permintaan
    $data = json_decode(file_get_contents("php://input"), true);

    // Mengambil data
    $nama = $conn->real_escape_string($data['nama']);
    $email = $conn->real_escape_string($data['email']);
    $kataSandi = $conn->real_escape_string($data['kataSandi']);

    // Hash kata sandi
    $hashedPassword = password_hash($kataSandi, PASSWORD_DEFAULT);
    
    // Cek apakah email sudah ada
    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo json_encode(array('success' => false, 'message' => 'Email sudah terdaftar.'));
        exit();
    } else {
        // Query untuk memasukkan data
        $insertQuery = "INSERT INTO users (nama, email, kata_sandi) VALUES ('$nama', '$email', '$hashedPassword')";
        
        // Eksekusi query dan periksa hasilnya
        if ($conn->query($insertQuery) === TRUE) {
            echo json_encode(array('success' => true, 'message' => 'Registrasi berhasil!', 'email' => $email));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data: ' . $conn->error));
        }
    }
}

$conn->close();
?>
