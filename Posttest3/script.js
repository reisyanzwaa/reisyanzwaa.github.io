let currentIndex = 0;
const slides = document.querySelectorAll('.carousel-item');
const totalSlides = slides.length;

// Fungsi untuk menampilkan slide berdasarkan index
function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active'); // Hapus kelas aktif dari semua slide
        if (i === index) {
            slide.classList.add('active'); // Tambahkan kelas aktif pada slide yang sesuai
        }
    });

    // Update posisi carousel-inner
    const carouselInner = document.querySelector('.carousel-inner');
    carouselInner.style.transform = `translateX(-${index * 100}%)`; // Pindahkan ke slide yang sesuai

    // Update indikator
    document.querySelectorAll('.indicator').forEach((indicator, i) => {
        indicator.classList.toggle('active', i === index);
    });
}

// Fungsi untuk menampilkan slide berikutnya
function nextSlide() {
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
showSlide(currentIndex);

// Fungsi untuk menampilkan atau menyembunyikan form pencarian
function toggleSearchFilter() {
    const searchFilterSection = document.getElementById('search-filter-section');
    searchFilterSection.style.display = (searchFilterSection.style.display === "none" || searchFilterSection.style.display === "") ? "block" : "none";
}

// Fungsi untuk menampilkan atau menyembunyikan form pencarian
function toggleSearchForm() {
    const form = document.getElementById('searchForm');
    form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
}

// Fungsi untuk melakukan pencarian produk
function searchProduct() {
    // Ambil nilai dari input form
    const name = document.getElementById('name').value;
    const size = document.getElementById('size').value;
    const color = document.getElementById('color').value;

    // Menampilkan hasil pencarian
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

    // Toggle antara 'dark-mode' dan 'light-mode'
    body.classList.toggle('dark-mode');
    body.classList.toggle('light-mode');

    // Toggle kelas untuk semua elemen lainnya
    elementsToToggle.forEach(element => {
        if (element) {
            element.classList.toggle('dark-mode');
        }
    });

    // Simpan pilihan mode ke localStorage
    localStorage.setItem('theme', body.classList.contains('dark-mode') ? 'dark' : 'light');
}

// Set theme saat halaman dimuat
window.onload = function() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        toggleDarkMode(); // Panggil fungsi untuk mengaktifkan dark mode
    } else {
        document.body.classList.add('light-mode'); // Tambahkan light mode jika tidak disimpan
    }
    
    console.log('Saved theme:', savedTheme);
};

// Menambahkan event listener untuk tombol tema
document.addEventListener("DOMContentLoaded", () => {
    const themeToggleButton = document.getElementById("theme-toggle");
    const searchToggleButton = document.getElementById("search-toggle");
    
    if (themeToggleButton) {
        themeToggleButton.addEventListener("click", () => {
            toggleDarkMode();
            themeToggleButton.textContent = document.body.classList.contains('dark-mode') ? "☀️" : "🌙"; // Ganti ikon
        });
    }

    if (searchToggleButton) {
        searchToggleButton.addEventListener("click", toggleSearchFilter);
    }

    // Event listener untuk tombol pencarian
    const searchFormButton = document.getElementById('searchFormButton');
    if (searchFormButton) {
        searchFormButton.addEventListener('click', searchProduct);
    }
});

function toggleMenu() {
    const hamburger = document.querySelector('.hamburger');
    hamburger.classList.toggle('active');
}

function toggleMenu() {
    const navMenu = document.querySelector('.nav-menu');
    navMenu.classList.toggle('active');
}