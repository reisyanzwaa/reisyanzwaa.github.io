<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGA">
</head>
<body>
<div class="container mt-5">
    <?php
    // Include file koneksi untuk menghubungkan ke database
    include "koneksi.php";

    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Cek apakah ada nilai yang dikirim menggunakan metode GET dengan nama id_peserta
    if (isset($_GET['id_peserta'])) {
        $id_peserta = input($_GET["id_peserta"]);

        $sql = "SELECT * FROM peserta WHERE id_peserta='$id_peserta'";
        $hasil = mysqli_query($kon, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_peserta = htmlspecialchars($_POST["id_peserta"]);
        $nama_lengkap = input($_POST["nama_lengkap"]); // Menggunakan nama lengkap
        $email = input($_POST["email"]); // Menggunakan email
        $kata_sandi = input($_POST["kata_sandi"]); // Menggunakan kata sandi
        $nomor_telepon = input($_POST["nomor_telepon"]); // Menggunakan nomor telepon

        // Query update data pada tabel peserta
        $sql = "UPDATE peserta SET
            nama_lengkap = '$nama_lengkap',
            email = '$email',
            kata_sandi = '$kata_sandi',
            nomor_telepon = '$nomor_telepon'
            WHERE id_peserta = '$id_peserta'";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location: index.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Data gagal disimpan.</div>";
        }
    }
    ?>

    <h2 class="text-center">Update Data</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $data['nama_lengkap']; ?>" placeholder="Masukkan Nama Lengkap" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" placeholder="Masukkan Email" required>
        </div>
        <div class="form-group">
            <label for="kata_sandi">Kata Sandi:</label>
            <input type="password" name="kata_sandi" class="form-control" placeholder="Masukkan Kata Sandi" required>
        </div>
        <div class="form-group">
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" name="nomor_telepon" class="form-control" value="<?php echo $data['nomor_telepon']; ?>" placeholder="Masukkan Nomor Telepon" required>
        </div>
        <input type="hidden" name="id_peserta" value="<?php echo $data['id_peserta']; ?>">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
