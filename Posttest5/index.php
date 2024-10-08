<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Chaussée - Toko</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="script.js"></script> <!-- Memasukkan script.js -->
</head>

<body>
    <header>
        <div class="nav-container">
            <div class="hamburger" onclick="toggleMenu()">&#9776; <!-- Hamburger icon -->
                <nav id="nav-menu">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                    </ul>
                </nav>
            </div>
            <div class="nav-icons">
                <div class="favorite-icon" onclick="window.location.href='search.html'">
                    <i class="fas fa-search"></i> <!-- Icon for search -->
                </div>
                <div class="toggle-mode" onclick="toggleDarkMode()">
                    <i class="fas fa-adjust"></i> <!-- Ikon untuk toggle mode -->
                </div>
            </div>
            <div class="logo">
                <img src="baglogo.png" alt="Logo Le Chaussée">
            </div>
            <div class="nav-icons">
                <div class="favorite-icon" onclick="window.location.href='favorites.html'">
                    <i class="fas fa-heart"></i> <!-- Icon for favorites -->
                </div>
                <div class="account-icon" onclick="window.location.href='login.html'">
                    <i class="fas fa-user"></i> <!-- Icon for account/login -->
                </div>
                <div class="cart-icon" onclick="window.location.href='cart.html'">
                    <i class="fas fa-shopping-cart"></i> <!-- Icon for shopping cart -->
                    <span class="cart-count" id="cart-count">0</span> <!-- Menampilkan jumlah item di keranjang -->
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Le Chaussée - Toko Sepatu</span>
    </nav>

    <div class="container">
        <br>
        <h4 class="text-center">DAFTAR PRODUK KAMI</h4>


        <?php
        include "koneksi.php";

        // Cek apakah ada kiriman form dari method GET
        if (isset($_GET['id_peserta'])) {
            $id_peserta = htmlspecialchars($_GET["id_peserta"]);

            $sql = "DELETE FROM peserta WHERE id_peserta='$id_peserta'";
            $hasil = mysqli_query($kon, $sql);

            // Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location: index.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'> Data gagal dihapus.</div>";
            }
        }
        ?>

        <table class="my-3 table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Kata Sandi</th>
                    <th>Nomor Telepon</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM peserta ORDER BY id_peserta DESC";
                $hasil = mysqli_query($kon, $sql);
                $no = 0;

                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo htmlspecialchars($data["nama_lengkap"]); ?></td>
                        <td><?php echo htmlspecialchars($data["email"]); ?></td>
                        <td><?php echo htmlspecialchars($data["kata_sandi"]); ?></td>
                        <td><?php echo htmlspecialchars($data["nomor_telepon"]); ?></td>
                        <td>
                            <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">Hapus</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-primary" role="button"> Tambah Data</a>

        <!-- Section Promo Banner -->
        <section class="promo-banner">
            <div class="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="sepatu_rbiru-removebg-preview.png" alt="Promo 1">
                        <div class="caption">Promo Spesial Sepatu Biru!</div>
                    </div>
                    <div class="carousel-item">
                        <img src="sayapputih-removebg-preview.png" alt="Promo 2">
                        <div class="caption">Dapatkan Sepatu Putih Terbaru!</div>
                    </div>
                    <div class="carousel-item">
                        <img src="olgabolongpink-removebg-preview.png" alt="Promo 3">
                        <div class="caption">Temukan Gaya dengan Sepatu Ungu!</div>
                    </div>
                </div>
                <!-- Tombol Kontrol untuk Menggeser Slide -->
                <button class="carousel-control prev" onclick="prevSlide()">&#10094;</button>
                <button class="carousel-control next" onclick="nextSlide()">&#10095;</button>
            </div>
            <div class="carousel-indicators">
                <span class="indicator active" onclick="showSlide(0)"></span>
                <span class="indicator" onclick="showSlide(1)"></span>
                <span class="indicator" onclick="showSlide(2)"></span>
            </div>
        </section>

        <!-- Section Featured Products -->
        <section class="product-section">
            <h2>Produk Unggulan</h2>

            <div class="promo-text">
                <h1>Le Chaussée</h1>
                <p>Jelajahi tren terbaru dalam sepatu Le Chaussée.</p>
            </div>

            <div class="product-grid">
                <!-- Product 1 -->
                <div class="product-card">
                    <img src="bintangpink-removebg-preview.png" alt="Nike Air Max 2021" class="product-image">
                    <h3>Nike Air Max 2021</h3>
                    <p class="product-price">Rp 2,499,000</p>
                    <button class="buy-now-btn" onclick="openPopup('Nike Air Max 2021', 'Rp 2,499,000')">Beli Sekarang</button>
                </div>
                <!-- Product 2 -->
                <div class="product-card">
                    <img src="garisolgabiru-removebg-preview.png" alt="Nike Air Force 1" class="product-image">
                    <h3>Nike Air Force 1</h3>
                    <p class="product-price">Rp 1,999,000</p>
                    <button class="buy-now-btn" onclick="openPopup('Nike Air Force 1', 'Rp 1,999,000')">Beli Sekarang</button>
                </div>
            </div>
        </section>

        <!-- Section Product Reviews -->
        <section class="review-section">
            <h2>Apa Kata Pelanggan Kami</h2>
            <div class="review-grid">
                <!-- Review 1 -->
                <div class="review-card">
                    <img src="bntanghitam-removebg-preview.png" alt="Nike Air Max 2021" class="review-image">
                    <div class="review-content">
                        <h3 class="review-title">Nike Air Max 2021</h3>
                        <div class="review-rating">
                            <span class="star">⭐</span>
                            <span class="star">⭐</span>
                            <span class="star">⭐</span>
                            <span class="star">⭐</span>
                            <span class="star">⭐</span>
                        </div>
                        <p class="review-text">"Kualitas terbaik, sangat nyaman dipakai!"</p>
                    </div>
                </div>
                <!-- Review 2 -->
                <div class="review-card">
                    <img src="garisolahitam-removebg-preview.png" alt="Nike Air Force 1" class="review-image">
                    <div class="review-content">
                        <h3 class="review-title">Nike Air Force 1</h3>
                        <div class="review-rating">
                            <span class="star">⭐</span>
                            <span class="star">⭐</span>
                            <span class="star">⭐</span>
                            <span class="star">⭐</span>
                            <span class="star">⭐</span>
                        </div>
                        <p class="review-text">"Sangat trendy dan stylish!"</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popup Box -->
        <div class="popup-box" id="popup-box" style="display: none;">
            <div class="popup-content">
                <h2 id="popup-title">Detail Pembelian</h2>
                <p id="popup-price"></p>
                <button class="popup-btn">Tambahkan ke Keranjang</button>
                <button onclick="closePopup()">Tutup</button>
            </div>
        </div>

        <footer>
            <p>© 2024 Le Chaussée. Semua Hak Dilindungi.</p>
        </footer>
    </div>
</body>

</html>
