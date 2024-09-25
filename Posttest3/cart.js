let totalAmount = 0;

function showCategory(category) {
    const categories = ['formal', 'non-formal', 'sport'];
    categories.forEach(cat => {
        document.getElementById('cart-list-' + cat).style.display = 'none';
    });
    document.getElementById('cart-list-' + category).style.display = 'block';
}

function removeItem(button) {
    const cartItem = button.closest('.cart-item');
    const priceText = cartItem.querySelector('strong').innerText;
    const priceValue = parseInt(priceText.replace(/[^0-9]/g, ''));

    cartItem.remove();
    totalAmount -= priceValue;
    document.getElementById('total-amount').innerText = 'Rp. ' + totalAmount;
}

function updateTotal() {
    let total = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        const priceText = item.querySelector('p:last-child').innerText;
        const price = parseInt(priceText.replace(/[^0-9]/g, ''), 10);
        total += price;
    });
    document.getElementById('totalAmount').innerText = total;
}

function showList(category) {
    // Sembunyikan semua daftar keranjang
    document.getElementById('cart-list-formal').style.display = 'none';
    document.getElementById('cart-list-cewek').style.display = 'none';
    document.getElementById('cart-list-cowok').style.display = 'none';

    // Tampilkan daftar yang sesuai dengan kategori
    if (category === 'formal') {
        document.getElementById('cart-list-formal').style.display = 'block';
    } else if (category === 'cewek') {
        document.getElementById('cart-list-cewek').style.display = 'block';
    } else if (category === 'cowok') {
        document.getElementById('cart-list-cowok').style.display = 'block';
    }
}

function toggleDarkMode() {
    const body = document.body;
    body.classList.toggle('dark-mode');

    // Simpan preferensi pengguna di localStorage
    if (body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.setItem('theme', 'light');
    }
}

// Cek preferensi pengguna saat halaman dimuat
window.onload = function() {
    const theme = localStorage.getItem('theme');
    if (theme === 'dark') {
        document.body.classList.add('dark-mode');
    }
};
