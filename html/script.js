document.addEventListener('DOMContentLoaded', () => {
    const table = document.getElementById('productTable');
    const headers = table.querySelectorAll('th.sortable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const searchInput = document.getElementById('searchInput');

    let sortColumn = -1;
    let sortDirection = 'asc'; // 'asc' or 'desc'

    headers.forEach((header, index) => {
        header.addEventListener('click', () => {
            const colIndex = parseInt(header.dataset.col);

            // Determine sort direction
            if (sortColumn === colIndex) {
                sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                sortDirection = 'asc'; // Default to ascending for a new column
            }

            // Remove existing sort indicators
            headers.forEach(h => {
                h.classList.remove('sorted-asc', 'sorted-desc');
            });

            // Add new sort indicator
            header.classList.add(sortDirection === 'asc' ? 'sorted-asc' : 'sorted-desc');

            sortColumn = colIndex;
            sortTable(colIndex, sortDirection);
        });
    });

    function sortTable(colIndex, direction) {
        const isNumeric = colIndex === 3; // "Giá" column is numeric

        rows.sort((rowA, rowB) => {
            let cellA = rowA.children[colIndex].textContent;
            let cellB = rowB.children[colIndex].textContent;

            if (isNumeric) {
                cellA = parseInt(cellA.replace(/[^0-9]/g, '')); // Remove non-numeric characters for comparison
                cellB = parseInt(cellB.replace(/[^0-9]/g, ''));
            } else {
                cellA = cellA.toLowerCase();
                cellB = cellB.toLowerCase();
            }

            if (cellA < cellB) {
                return direction === 'asc' ? -1 : 1;
            }
            if (cellA > cellB) {
                return direction === 'asc' ? 1 : -1;
            }
            return 0;
        });

        // Clear existing rows and append sorted rows
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        rows.forEach(row => tbody.appendChild(row));
    }

    searchInput.addEventListener('keyup', searchTable);

    function searchTable() {
        const searchTerm = searchInput.value.toLowerCase();

        rows.forEach(row => {
            let rowMatches = false;
            Array.from(row.children).forEach(cell => {
                const originalText = cell.textContent;
                let highlightedText = originalText;

                if (searchTerm && originalText.toLowerCase().includes(searchTerm)) {
                    rowMatches = true;
                    const regex = new RegExp(searchTerm, 'gi');
                    highlightedText = originalText.replace(regex, match => `<span class="highlight">${match}</span>`);
                }
                cell.innerHTML = highlightedText;
            });

            if (rowMatches) {
                row.style.display = ''; // Show row
            } else {
                row.style.display = 'none'; // Hide row
            }
        });
    }
});
