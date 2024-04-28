<?php
require_once 'config.php';

//keep from redirection
header(
    'Content-Type: application/json; charset=utf-8'
);

if (isset($_POST["Import"])) {


    $con = getdb();

    $fileInput = $_FILES["fileInput"]["tmp_name"];
    $campaign = $_POST['campaign'];
    $successCount = 0; // Initialize success count
    $duplicateCount = 0; // Initialize duplicate count
    $invalidPhoneCount = 0; // Initialize invalid phone number count
    $firstRow = true;
    $error;

    if ($campaign == "") {
        $error = "Por favor, insira o nome da campanha.";
    }
    
    if ($fileInput == "") {
        $error = "Por favor, selecione um arquivo CSV.";
    }

    if (isset($error)) {
        //return error message in json format
        echo json_encode(array('error' => $error));
        exit;
    }

    if ($_FILES["fileInput"]["size"] > 0) {
        
        $file = fopen($fileInput, "r");

        // error_log("Amount of rows in csv is ");

        while (($getData = fgetcsv($file, 100000, ";")) !== false) {

            // Skip the first row
            if ($firstRow) {
                $firstRow = false;
                continue;
            }

            // error_log("CSV Row Data: " . print_r($getData, true));
            // Convert data to UTF-8
            $getData = array_map('utf8_encode', $getData);

            // Assigning null to each parameter if the element doesn't exist or is empty
            $nome = isset($getData[0]) && !empty($getData[0]) ? $getData[0] : null;
            $sobrenome = isset($getData[1]) && !empty($getData[1]) ? $getData[1] : null;
            $email = isset($getData[2]) && !empty($getData[2]) ? $getData[2] : null;
            $telefone = isset($getData[3]) && !empty($getData[3]) ? $getData[3] : null;
            $endereco = isset($getData[4]) && !empty($getData[4]) ? $getData[4] : null;
            $cidade = isset($getData[5]) && !empty($getData[5]) ? $getData[5] : null;
            $cep = isset($getData[6]) && !empty($getData[6]) ? $getData[6] : null;
            $data_nascimento = isset($getData[7]) && !empty($getData[7]) ? date('Y-m-d', strtotime($getData[7])) : null;

            // Check if phone number is valid Brazilian number starting with 55
            if (!preg_match('/^55\d{2}\d{4,5}\d{4}$/', $telefone)) {
                // Increment invalid phone number count
                $invalidPhoneCount++;
            } else {
                // Insert data into the database
                $sql = "INSERT INTO contacts (nome, sobrenome, email, telefone, endereco, cidade, cep, data_nascimento) 
                        VALUES ('$nome', '$sobrenome', '$email', '$telefone', '$endereco', '$cidade', '$cep', '$data_nascimento')";

                if (mysqli_query($con, $sql)) {
                    // Check if the insertion was successful
                    if (mysqli_affected_rows($con) > 0) {
                        // Increment success count
                        $successCount++;
                    } else {
                        // Increment duplicate count if the record already exists
                        $duplicateCount++;
                    }
                }
            }
        }

        fclose($file);

        // Prepare data to return as JSON object
        $response = array(
            'successAmount' => $successCount,
            'infoAmount' => $duplicateCount,
            'errorAmount' => $invalidPhoneCount,
        );

        // Encode the data into JSON format
        $jsonData = json_encode($response);

        // Output the JSON data without redirececting
        
        echo $jsonData;

    }
} else {
    $response = array(
        $error = "Por favor, selecione um arquivo CSV."
    );
    $jsonData = json_encode($response);
    echo $jsonData;
}
