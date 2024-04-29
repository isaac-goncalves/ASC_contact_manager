<?php
// Include database connection code
include '../config/config.php';

$conn = getdb();

// Initialize variables
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

$itemsPerPage = isset($_GET['itemsPerPage']) && is_numeric($_GET['itemsPerPage']) ? $_GET['itemsPerPage'] : 10;

$offset = ($page - 1) * $itemsPerPage;

// Grab get data
$sql = '';


if (!isset($_GET['campaing_id'])) {
    $sql = "SELECT 
            contacts.id,
            campaings.nome as campanha,
            contacts.nome,
            contacts.sobrenome,
            contacts.email,
            contacts.telefone,
            contacts.endereco,
            contacts.cidade,
            contacts.cep,
            contacts.data_nascimento
        FROM contacts
        INNER JOIN campaings ON contacts.campaing_id = campaings.id
        LIMIT $offset, $itemsPerPage";
} else {
    $campaing_id = $_GET['campaing_id'];

    // Fetch data from MySQL database with pagination
    $sql = "SELECT 
            contacts.id,
            campaings.nome as campanha,
            contacts.nome,
            contacts.sobrenome,
            contacts.email,
            contacts.telefone,
            contacts.endereco,
            contacts.cidade,
            contacts.cep,
            contacts.data_nascimento
        FROM contacts
        INNER JOIN campaings ON contacts.campaing_id = campaings.id
        WHERE campaings.id = $campaing_id
        LIMIT $offset, $itemsPerPage";
}

$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
 
    // Output data in JSON format masking phone and date
    $contacts = array();

    while ($row = $result->fetch_assoc()) {
        $row['telefone'] = maskPhone($row['telefone']);
        $row['data_nascimento'] = maskDate($row['data_nascimento']);
        $contacts[] = $row;
    }

    //findLastPage

    $sql = "SELECT COUNT(*) AS total FROM contacts";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalItems = $row['total'];
    $totalPages = ceil($totalItems / $itemsPerPage);

   $response = array(
        'contacts' => $contacts,
        'totalItems' => $totalItems,
        'totalPages' => $totalPages
    );

    echo json_encode($response);
} else {
    echo json_encode(['contacts' => [], 'totalItems' => 0, 'totalPages' => 0]);
}

// Close database connection
$conn->close();

function maskPhone($phone)
{
    // Mask phone number to be 55 (12) 34567-8901 for numbers not with 9 and 55 (12) 93456-7890 for numbers with 9
    if (preg_match('/^55\d{2}9\d{4,5}\d{4}$/', $phone)) {
        return preg_replace('/^55(\d{2})(\d{5})(\d{4})$/', '55 ($1) $2-$3', $phone);
    } else {
        return preg_replace('/^55(\d{2})(\d{4,5})(\d{4})$/', '55 ($1) $2-$3', $phone);
    }
}

function maskDate($date)
{
    return date('d/m/Y', strtotime($date));
}
?>