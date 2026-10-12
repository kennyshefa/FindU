document.addEventListener('DOMContentLoaded', function () {
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userDropdown = document.querySelector('.user-dropdown');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const itemCards = document.querySelectorAll('.item-card');
    const searchInput = document.getElementById('searchInput');

    // 1. Logika Dropdown User (Akan aktif hanya jika user sudah login)
    if (userMenuBtn && userDropdown) {
        userMenuBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });

        document.addEventListener('click', function () {
            userDropdown.classList.remove('show');
        });
    }

    // 2. Filter Kategori Barang (Semua / Hilang / Ditemukan)
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const filterValue = button.getAttribute('data-filter');

            itemCards.forEach(card => {
                const category = card.getAttribute('data-category');
                if (filterValue === 'all' || category === filterValue) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // 3. Pencarian Kata Kunci
    if (searchInput) {
        searchInput.addEventListener('keyup', function () {
            const searchTerm = searchInput.value.toLowerCase();
            
            itemCards.forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                const location = card.querySelector('.card-info').textContent.toLowerCase();

                if (title.includes(searchTerm) || location.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});