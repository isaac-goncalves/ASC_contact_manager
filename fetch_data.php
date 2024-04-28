<?php
// Include database connection code
include 'config.php';

$conn = getdb();

// Fetch data from MySQL database
$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {

    //Mask phone number
    

    // Output data in HTML table format
    echo '<div class="overflow-x-auto">';
    echo '<table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">';
    echo '<thead class="bg-gray-50 border-b border-gray-200">';
    echo '<tr>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sobrenome</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefone</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Endereço</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cidade</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CEP</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data de Nascimento</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody class="divide-y divide-gray-200">';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td class="px-6 py-4 whitespace-nowrap">' . $row["id"] . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">' . $row["nome"] . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">' . $row["sobrenome"] . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">' . $row["email"] . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">' . maskPhone($row["telefone"]) . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">' . $row["endereco"] . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">' . $row["cidade"] . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">' . $row["cep"] . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap text-center">' . maskDate($row["data_nascimento"]) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo '<p class="text-gray-500">Nenhum contato encontrado.</p>';
}

function maskPhone($phone){
    // Mask phone number to be 55 (12) 34567-8901 for numbers not with 9 and 55 (12) 93456-7890 for numbers with 9
    if (preg_match('/^55\d{2}9\d{4,5}\d{4}$/', $phone)) {
        return preg_replace('/^55(\d{2})(\d{5})(\d{4})$/', '55 ($1) $2-$3', $phone);
    } else {
        return preg_replace('/^55(\d{2})(\d{4,5})(\d{4})$/', '55 ($1) $2-$3', $phone);
    }
}

function maskDate($date){
    return date('d/m/Y', strtotime($date));
}


// Close database connection
$conn->close();