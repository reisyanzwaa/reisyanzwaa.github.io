<?php
require "koneksi.php"; // Pastikan koneksi ke database sudah benar

// Ambil data mahasiswa
$sql = mysqli_query($conn, "SELECT * FROM mhs");
$mahasiswa = [];
while ($row = mysqli_fetch_assoc($sql)) {
    $mahasiswa[] = $row;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa - Le Chaussée</title>
    <link rel="stylesheet" href="css_admin.css">
    <link rel="stylesheet" href="crud.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <h1>Data Mahasiswa</h1>
    <div class="container">
        <a href="tambah.php"><button class="tambah">Tambah Mahasiswa</button></a>
        <a href="index.php"><button class="back">Kembali</button></a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Kelas</th>
                <th>Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($mahasiswa as $mhs): ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><img src="images/<?php echo $mhs['foto']; ?>" alt="<?php echo $mhs['nama']; ?>" width="80px" height="100px"></td>
                    <td><?php echo $mhs['nama']; ?></td>
                    <td><?php echo $mhs['nim']; ?></td>
                    <td><?php echo $mhs['kelas']; ?></td>
                    <td><?php echo $mhs['prodi']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $mhs['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $mhs['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
            <?php $i++; endforeach; ?>
        </tbody>
    </table>
</body>
</html>
