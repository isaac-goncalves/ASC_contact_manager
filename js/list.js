window.addEventListener('DOMContentLoaded', (event) => {
    // Variables to track pagination state
    let currentPage = 1;
    let itemsPerPage = 10; // Number of items to display per page
    let totalPages = 1;

    // Fetch data from the database
    fetch('./functions/fetch_campaings.php')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('contacts');
            data.forEach(campaing => {
                const option = document.createElement('option');
                option.value = campaing.id;
                option.text = campaing.nome;
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });

    // onselectChange render Table 
    document.getElementById('contacts').addEventListener('change', fetchContactsData);


    function fetchContactsData(event) {
        const loadingSpinner = document.getElementById('loadingSpinner');
        loadingSpinner.style.display = 'flex';

        itemsPerPage = document.getElementById('itemsPerPageSelect').value || 10;
        const campaing_id = document.getElementById('contacts').value || 1;
        const noDataMessage = document.getElementById('noDataMessage');

        const params = {
            campaing_id: campaing_id,
            page: currentPage,
            itemsPerPage
        };

        const urlParams = new URLSearchParams(params);

        fetch(`./functions/fetch_data.php?${urlParams}`)
            .then(response => response.json())
            .then(data => {
                renderTable(data.contacts);
                totalPages = data.totalPages;
                setPaginationCounter();
                loadingSpinner.style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Render styled table function
    function renderTable(data) {

        const table = document.getElementById('contacts-table');

        const tbody = table.querySelector('tbody');
        tbody.innerHTML = '';

        if (data.length > 0) {

            //show table
            table.style.display = 'block';
            noDataMessage.style.display = 'none';

            tbody.innerHTML = '';
            data.forEach(contact => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-4 py-4 whitespace-nowrap text-sm border-b">${contact.id}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm border-b">${contact.campanha}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm border-b">${contact.nome}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm border-b">${contact.sobrenome}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm border-b">${contact.email}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm border-b">${contact.telefone}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm border-b">${contact.endereco}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm border-b">${contact.cidade}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm border-b">${contact.cep}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm border-b text-center">${contact.data_nascimento}</td>
                `;
                tbody.appendChild(row);
            });
        } else {
            //show No data message
            noDataMessage.style.display = 'block';

        }
    }

    // Pagination controls

    const pageCounter = document.getElementById('pageCounter');
    const itemsPerPageSelect = document.getElementById('itemsPerPageSelect');

    itemsPerPageSelect.addEventListener('change', () => {
        itemsPerPage = itemsPerPageSelect.value;
        fetchContactsData();
    });

    function setPaginationCounter() {
        pageCounter.innerHTML = "Pagina " + currentPage + " de " + totalPages;
    }

    document.getElementById('prevPageBtn').addEventListener('click', () => {

        if (currentPage === 1) return;

        currentPage--;
        pageCounter.innerHTML = "Pagina " + currentPage + " de " + totalPages;
        fetchContactsData();

    });

    document.getElementById('nextPageBtn').addEventListener('click', () => {

        if (currentPage === totalPages) return;

        currentPage++;
        pageCounter.innerHTML = "Pagina " + currentPage + " de " + totalPages;
        fetchContactsData();

    });
});