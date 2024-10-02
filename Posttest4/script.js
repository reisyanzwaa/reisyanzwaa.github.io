// Menginisialisasi variabel untuk hamburger menu
const hamburger = document.querySelector('.hamburger');
const navMenu = document.getElementById('nav-menu');
let cart = [];

// Fungsi untuk menampilkan atau menyembunyikan menu
function toggleMenu() {
    console.log("Hamburger menu clicked!"); // Debug log
    hamburger.classList.toggle('active');
    navMenu.classList.toggle('active');
    console.log("Menu status:", navMenu.classList.contains('active'));
}


// Menambahkan event listener untuk hamburger
document.addEventListener("DOMContentLoaded", () => {
    if (hamburger && navMenu) {
        hamburger.addEventListener("click", toggleMenu); // Mengatur toggle menu
    }

    // Event listener untuk tema dan pencarian
    const themeToggleButton = document.getElementById("theme-toggle");
    const searchToggleButton = document.getElementById("search-toggle");

    // Cek jika tombol tema ada, tambahkan event listener
    if (themeToggleButton) {
        themeToggleButton.addEventListener("click", () => {
            toggleDarkMode();
            themeToggleButton.textContent = document.body.classList.contains('dark-mode') ? "☀️" : "🌙"; // Ganti ikon
        });
    }

    // Cek jika tombol pencarian ada, tambahkan event listener
    if (searchToggleButton) {
        searchToggleButton.addEventListener("click", toggleSearchFilter);
    }

    // Event listener untuk tombol pencarian
    const searchFormButton = document.getElementById('searchFormButton');
    if (searchFormButton) {
        searchFormButton.addEventListener('click', searchProduct);
    }

    // Memuat cart dari localStorage
    const savedCart = localStorage.getItem('cart');
    if (savedCart) {
        cart = JSON.parse(savedCart);
        document.getElementById('cart-count').innerText = cart.length; // Update jumlah item di keranjang
    }
});

// Fungsi untuk menampilkan slide berikutnya
function nextSlide() {
    let currentIndex = 0;
    const totalSlides = document.querySelectorAll('.carousel-item').length;

    currentIndex = (currentIndex + 1) % totalSlides; // Berpindah ke slide berikutnya
    showSlide(currentIndex);
}

// Fungsi untuk menampilkan slide sebelumnya
function prevSlide() {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides; // Berpindah ke slide sebelumnya
    showSlide(currentIndex); // Tampilkan slide setelah update index
}

// Mengatur interval untuk berpindah slide secara otomatis setiap 5 detik
setInterval(nextSlide, 5000);

// Menampilkan slide pertama saat halaman dimuat
showSlide(0);

// Fungsi untuk menampilkan atau menyembunyikan form pencarian
function toggleSearchFilter() {
    const searchFilterSection = document.getElementById('search-filter-section');
    searchFilterSection.style.display = (searchFilterSection.style.display === "none" || searchFilterSection.style.display === "") ? "block" : "none";
}

// Fungsi untuk melakukan pencarian produk
function searchProduct() {
    const name = document.getElementById('name').value;
    const size = document.getElementById('size').value;
    const color = document.getElementById('color').value;

    const results = document.getElementById('searchResults');
    results.style.display = 'block';
    results.innerHTML = `
        <h3>Hasil Pencarian:</h3>
        <p>Nama: ${name || 'Tidak ada'}</p>
        <p>Ukuran: ${size || 'Tidak ada'}</p>
        <p>Warna: ${color || 'Tidak ada'}</p>
    `;
}

// Fungsi untuk mengubah mode gelap dan terang
function toggleDarkMode() {
    const body = document.body;
    const elementsToToggle = [
        document.querySelector('.header'),
        document.querySelector('.promo-banner'),
        document.querySelector('.product-section'),
        document.querySelector('.review-section'),
        document.querySelector('footer')
    ];

    body.classList.toggle('dark-mode');
    body.classList.toggle('light-mode');

    elementsToToggle.forEach(element => {
        if (element) {
            element.classList.toggle('dark-mode');
        }
    });

    localStorage.setItem('theme', body.classList.contains('dark-mode') ? 'dark' : 'light');
}

// Set theme saat halaman dimuat
window.onload = function() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        toggleDarkMode();
    } else {
        document.body.classList.add('light-mode');
    }
};

// Fungsi untuk menutup popup
function closePopup() {
    document.getElementById('popup-box').style.display = 'none';
}

// Fungsi untuk menambahkan produk ke keranjang
function addToCart() {
    const title = document.getElementById('popup-box').dataset.title;
    const price = document.getElementById('popup-box').dataset.price;

    const product = { title, price };
    cart.push(product);
    localStorage.setItem('cart', JSON.stringify(cart));

    document.getElementById('cart-count').innerText = cart.length;

    closePopup();
    alert(`${title} telah ditambahkan ke keranjang!`);
}

// Fungsi untuk membuka popup
function openPopup(title, price) {
    document.getElementById('popup-title').innerText = title;
    document.getElementById('popup-price').innerText = price;
    document.getElementById('popup-box').style.display = 'block';
}

// Fungsi untuk menambahkan event listener jika elemen ada
function addEventListenerIfExists(element, event, callback) {
    if (element) {
        element.addEventListener(event, callback);
    }
}

addEventListenerIfExists(hamburger, "click", toggleMenu);
