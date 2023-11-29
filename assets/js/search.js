document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('.search input');
    const searchButton = document.querySelector('.search img');
    const tableRows = document.querySelectorAll('.table table tr');

    const tableHeader = document.querySelector('.table-header');
    searchButton.addEventListener('click', function () {
        const searchTerm = searchInput.value.trim().toLowerCase();

        tableRows.forEach(function (row) {
            const cells = row.getElementsByTagName('td');
            let found = false;

            for (let i = 0; i < cells.length; i++) {
                const cellText = cells[i].textContent.toLowerCase();

                if (cellText.includes(searchTerm)) {
                    found = true;
                    break;
                }
            }

            if (found) {
                row.style.display = ''; // Menampilkan baris yang cocok
            } else {
                row.style.display = 'none'; // Menyembunyikan baris yang tidak cocok
            }
        });
        tableHeader.style.display = '';
    });
});
