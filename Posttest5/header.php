<!-- index.php -->
<?php
$name = "";
$email = "";
$age = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $age = htmlspecialchars($_POST['age']);
    $message = "Data berhasil disubmit: <br>Nama: $name <br>Email: $email <br>Usia: $age";
}
?>

<?php include 'header.php'; ?>

<main>
    <h1>Form Pendaftaran</h1>
    <form method="POST" action="">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="age">Usia:</label>
        <input type="number" id="age" name="age" min="1" required>

        <button type="submit">Kirim</button>
    </form>

    <?php if ($message): ?>
        <div class="result">
            <h2>Hasil Inputan</h2>
            <p><?php echo $message; ?></p>
        </div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
