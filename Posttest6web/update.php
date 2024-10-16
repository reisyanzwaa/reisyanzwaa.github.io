<?php
require "koneksi.php"; // Pastikan koneksi ke database sudah benar

if (isset($_POST['tambah'])) { // Mengecek apakah $_POST['tambah'] bernilai true
    $nama = $_POST['nama']; // Mengambil data dari form nama
    $nim = $_POST['nim']; // Mengambil data dari form nim
    $kelas = $_POST['kelas']; // Mengambil data dari form kelas
    $prodi = $_POST['prodi']; // Mengambil data dari form prodi

    $tmp_name = $_FILES['foto']['tmp_name'];
    $file_name = $_FILES['foto']['name'];

    // Cek apakah file adalah gambar dengan ekstensi valid
    $validExtension = ['jpg', 'jpeg', 'png'];
    $fileExtension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); // Ambil ekstensi file
    if (!in_array($fileExtension, $validExtension)) {
        echo "
            <script>
                alert('File yang diupload bukan gambar! Ekstensi yang valid: jpg, jpeg, png');
                document.location.href = 'CRUDAdmin.php';
            </script>";
        exit;
    }

    // Membuat nama file baru
    $newFileName = date('d-m-Y') . '-' . basename($file_name); // Gunakan basename untuk menghindari path traversal

    // Pastikan direktori untuk menyimpan gambar ada
    if (!is_dir('images')) {
        mkdir('images', 0777, true); // Buat direktori jika belum ada
    }

    // Cek apakah file berhasil dipindahkan
    if (move_uploaded_file($tmp_name, 'images/' . $newFileName)) {
        $sql = "INSERT INTO mhs (nama, nim, kelas, prodi, foto) VALUES ('$nama', '$nim', '$kelas', '$prodi', '$newFileName')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "
                <script>
                    alert('Berhasil menambah data mahasiswa!');
                    document.location.href = 'CRUDAdmin.php';
                </script>";
        } else {
            echo "
                <script>
                    alert('Gagal menambah data mahasiswa: " . mysqli_error($conn) . "');
                    document.location.href = 'CRUDAdmin.php';
                </script>";
        }
    } else {
        echo "
            <script>
                alert('Gagal upload gambar! Pastikan direktori writable.');
                document.location.href = 'CRUDAdmin.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang Kami | Pendataan Mahasiswa Universitas Mulawarman</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="styles/base.css" />
    <link rel="stylesheet" href="styles/home.css" />
    <link rel="stylesheet" href="styles/admin.css">
    <link rel="stylesheet" href="styles/crud.css">
</head>

<body>

    <main class="data-mahasiswa-section">
        <h1 class="data-mahasiswa-title">
            Tambah Data Mahasiswa
        </h1>

        <div class="container">
            <a href="CRUDAdmin.php">
                <button class="back">
                    <p>Back</p>
                </button>
            </a>
        </div>

        <div class="form-mhs">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-field">
                    <label class="label-field" for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" value="" required>
                </div>
                <div class="input-field">
                    <label class="label-field" for="nim">NIM</label>
                    <input type="number" name="nim" id="nim" value="" required>
                </div>
                <div class="input-field">
                    <label class="label-field" for="kelas">Kelas</label>
                    <div class="form-check">
                        <input type="radio" name="kelas" id="kelasA" value="A" required />
                        <label for="kelasA">A</label></br>
                        <input type="radio" name="kelas" id="kelasB" value="B" />
                        <label for="kelasB">B</label></br>
                        <input type="radio" name="kelas" id="kelasC" value="C" />
                        <label for="kelasC">C</label>
                    </div>
                </div>
                <div class="input-field">
                    <label class="label-field" for="prodi">Program Studi</label>
                    <select name="prodi" id="prodi" required>
                        <option value="Informatika">Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                    </select>
                </div>

                <div class="input-field">
                    <label class="label-field" for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" accept="image/*" required>
                </div>

                <input class="button" type="submit" value="Tambah" name="tambah">
            </form>
        </div>

    </main>

    <script src="/scripts/script.js"></script>
</body>

</html>
