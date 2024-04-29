window.addEventListener('DOMContentLoaded', (event) => {
    // Fetch data from the database
    fetch('./functions/fetch_campaings.php')
        .then(response => response.json())
        .then(data => {
            // console.log(data);
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

    document.getElementById('contacts').addEventListener('change', (event) => {

        const loadingSpinner = document.getElementById('loadingSpinner');
        loadingSpinner.style.display = 'flex';

        const campaing_id = event.target.value;
        fetch(`./functions/fetch_data.php?campaing_id=${campaing_id}`)
            .then(response => response.json())
            .then(data => {
                renderTable(data);
                loadingSpinner.style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    // Render styled table function

    function renderTable(data) {

        const table = document.getElementById('contacts-table');

        if (data.length > 0) {
            table.style.display = 'block';
            const tbody = table.querySelector('tbody');
            tbody.innerHTML = '';
            data.forEach(contact => {
                const row = document.createElement('tr');
                row.innerHTML = `
                        <td class="px-4 py-4 whitespace-nowrap">${contact.id}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${contact.campanha}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${contact.nome}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${contact.sobrenome}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${contact.email}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${contact.telefone}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${contact.endereco}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${contact.cidade}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${contact.cep}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${contact.data_nascimento}</td>
                    `;
                tbody.appendChild(row);
            });
        } else {
            table.style.display = 'none';
        }
    }

    
});