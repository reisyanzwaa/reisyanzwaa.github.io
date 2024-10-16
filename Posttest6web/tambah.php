<?php
require "koneksi.php"; // Pastikan koneksi ke database sudah benar

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $kelas = $_POST['kelas'];
    $prodi = $_POST['prodi'];

    // Upload Foto
    $tmp_name = $_FILES['foto']['tmp_name'];
    $file_name = $_FILES['foto']['name'];
    $newFileName = date('d-m-Y') . '-' . $file_name;

    // Cek error upload
    $error = $_FILES['foto']['error'];
    if ($error !== UPLOAD_ERR_OK) {
        echo "<script>alert('Gagal upload gambar. Kode error: $error'); window.location.href = 'CRUDAdmin.php';</script>";
        exit; // Hentikan eksekusi
    }

    // Cek apakah file berhasil dipindahkan
    if (move_uploaded_file($tmp_name, 'images/' . $newFileName)) {
        // Simpan data ke database
        $sql = "INSERT INTO mhs (nama, nim, kelas, prodi, foto) VALUES ('$nama', '$nim', '$kelas', '$prodi', '$newFileName')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Berhasil menambah data mahasiswa!'); window.location.href = 'CRUDAdmin.php';</script>";
        } else {
            echo "<script>alert('Gagal menambah data mahasiswa!'); window.location.href = 'CRUDAdmin.php';</script>";
        }
    } else {
        echo "<script>alert('Gagal upload gambar ke folder.'); window.location.href = 'CRUDAdmin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa - Le Chaussée</title>
    <link rel="stylesheet" href="css_admin.css">
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nama">Nama Lengkap:</label>
        <input type="text" name="nama" required>

        <label for="nim">NIM:</label>
        <input type="number" name="nim" required>

        <label for="kelas">Kelas:</label>
        <select name="kelas" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        </select>

        <label for="prodi">Program Studi:</label>
        <select name="prodi" required>
            <option value="Informatika">Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
        </select>

        <label for="foto">Foto:</label>
        <input type="file" name="foto" required>

        <button type="submit" name="tambah">Tambah</button>
    </form>
    <a href="CRUDAdmin.php">Kembali</a>
</body>
</html>
