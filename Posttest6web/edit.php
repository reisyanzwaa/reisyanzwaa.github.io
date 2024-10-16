<?php
require "koneksi.php"; // Pastikan koneksi ke database sudah benar

$id = $_GET['id'];
$sql = "SELECT * FROM mhs WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$mhs = mysqli_fetch_assoc($result);

// Jika data mahasiswa tidak ditemukan, tampilkan pesan dan hentikan eksekusi
if (!$mhs) {
    echo "<script>alert('Data mahasiswa tidak ditemukan!'); window.location.href = 'CRUDAdmin.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $kelas = $_POST['kelas'];
    $prodi = $_POST['prodi'];
    $foto = $_FILES['foto']['name'];

    // Menyusun query dasar
    $sql = "UPDATE mhs SET nama='$nama', nim='$nim', kelas='$kelas', prodi='$prodi'";

    if ($foto) {
        // Jika foto diupload, proses upload
        $tmp_name = $_FILES['foto']['tmp_name'];
        $newFileName = date('d-m-Y') . '-' . basename($foto); // Gunakan basename untuk menghindari path traversal

        // Memindahkan file ke direktori yang ditentukan
        if (move_uploaded_file($tmp_name, 'images/' . $newFileName)) {
            $sql .= ", foto='$newFileName'"; // Tambahkan bagian foto ke query
        } else {
            echo "<script>alert('Gagal mengupload gambar!'); window.location.href = 'CRUDAdmin.php';</script>";
            exit;
        }
    }

    $sql .= " WHERE id='$id'"; // Menyelesaikan query dengan kondisi id

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Berhasil mengupdate data mahasiswa!'); window.location.href = 'CRUDAdmin.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data mahasiswa: " . mysqli_error($conn) . "'); window.location.href = 'CRUDAdmin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa - Le Chaussée</title>
    <link rel="stylesheet" href="css_admin.css">
</head>
<body>
    <h1>Edit Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nama">Nama Lengkap:</label>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($mhs['nama']); ?>" required>

        <label for="nim">NIM:</label>
        <input type="number" name="nim" value="<?php echo htmlspecialchars($mhs['nim']); ?>" required>

        <label for="kelas">Kelas:</label>
        <select name="kelas" required>
            <option value="A" <?php echo ($mhs['kelas'] == 'A') ? 'selected' : ''; ?>>A</option>
            <option value="B" <?php echo ($mhs['kelas'] == 'B') ? 'selected' : ''; ?>>B</option>
            <option value="C" <?php echo ($mhs['kelas'] == 'C') ? 'selected' : ''; ?>>C</option>
        </select>

        <label for="prodi">Program Studi:</label>
        <select name="prodi" required>
            <option value="Informatika" <?php echo ($mhs['prodi'] == 'Informatika') ? 'selected' : ''; ?>>Informatika</option>
            <option value="Sistem Informasi" <?php echo ($mhs['prodi'] == 'Sistem Informasi') ? 'selected' : ''; ?>>Sistem Informasi</option>
        </select>

        <label for="foto">Foto (Kosongkan jika tidak ingin mengganti):</label>
        <input type="file" name="foto" accept="image/*">

        <button type="submit" name="update">Update</button>
    </form>
    <a href="CRUDAdmin.php">Kembali</a>
</body>
</html>
