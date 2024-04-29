<?php
// Include database connection code
include '../config/config.php';


$conn = getdb();

// Fetch data from MySQL database
$sql = "SELECT 
            campaings.id,
            campaings.nome
        FROM campaings
";
$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    $campaings = array();
    while ($row = $result->fetch_assoc()) {
        $campaings[] = $row;
    }
    // Output data in JSON format
    echo json_encode($campaings);
} else {
    echo json_encode(array());
}

// Close database connection
$conn->close();