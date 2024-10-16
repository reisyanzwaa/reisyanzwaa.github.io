<?php
// search.php
// Memastikan data diterima dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil dan menyaring data dari form
    $criteria = htmlspecialchars($_POST['criteria']);
    $searchQuery = htmlspecialchars($_POST['searchQuery']);
    $productSize = htmlspecialchars($_POST['productSize']);
    $password = htmlspecialchars($_POST['password']);

    // Simulasi hasil pencarian (seharusnya diambil dari database)
    $products = [
        ["name" => "Sepatu Nike Air Max", "size" => 42, "color" => "Hitam", "description" => "Sepatu olahraga yang nyaman dan stylish."],
        ["name" => "Sepatu Adidas Ultraboost", "size" => 40, "color" => "Putih", "description" => "Sepatu lari dengan teknologi boost."],
        ["name" => "Sepatu Converse All Star", "size" => 38, "color" => "Merah", "description" => "Klasik dan cocok untuk berbagai gaya."],
        // Tambahkan produk lain di sini
    ];

    $results = [];
    
    // Mencari produk sesuai kriteria
    foreach ($products as $product) {
        if ($criteria == "name" && stripos($product['name'], $searchQuery) !== false) {
            $results[] = $product;
        } elseif ($criteria == "size" && $product['size'] == $productSize) {
            $results[] = $product;
        } elseif ($criteria == "color" && stripos($product['color'], $searchQuery) !== false) {
            $results[] = $product;
        }
    }

    // Membuat hasil pencarian
    if (count($results) > 0) {
        $resultHtml = "<h2>Hasil Pencarian:</h2>";
        foreach ($results as $result) {
            $resultHtml .= "<div>";
            $resultHtml .= "<h3>" . htmlspecialchars($result['name']) . "</h3>";
            $resultHtml .= "<p>Ukuran: " . htmlspecialchars($result['size']) . "</p>";
            $resultHtml .= "<p>Warna: " . htmlspecialchars($result['color']) . "</p>";
            $resultHtml .= "<p>" . htmlspecialchars($result['description']) . "</p>";
            $resultHtml .= "</div>";
        }
    } else {
        $resultHtml = "<p>Tidak ada hasil ditemukan.</p>";
    }

    // Redirect kembali ke index.php dengan hasil
    header("Location: index.php?results=" . urlencode($resultHtml));
    exit();
} else {
    // Jika tidak ada data yang diterima
    header("Location: index.php");
    exit();
}
?>
