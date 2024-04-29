<?php
require_once 'config.php';

//keep from redirection
header(
    'Content-Type: application/json; charset=utf-8'
);

if (isset($_POST["Import"])) {


    $con = getdb();

    $fileInput = $_FILES["fileInput"]["tmp_name"];
    $campaing = $_POST['campaing'];
    $successCount = 0; // Initialize success count
    $duplicateCount = 0; // Initialize duplicate count
    $invalidPhoneCount = 0; // Initialize invalid phone number count
    $firstRow = true;
    $error;
    $invalidPhoneData = array();

    if ($campaing == "") {
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

        //verify if campaing already exists
        $sql = "SELECT * FROM campaings WHERE nome = '$campaing'";
        $result = mysqli_query($con, $sql);
        $campain_id = null;
        while ($row = mysqli_fetch_assoc($result)) {
            $campain_id = $row['id'];
        }

        if ($campain_id == null) {
            $sql = "INSERT INTO campaings (nome) VALUES ('$campaing')";
            if (mysqli_query($con, $sql)) {
                $campain_id = mysqli_insert_id($con);
            }
        }

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
                // Add invalid phone number data to array
                $invalidPhoneData[] = array(
                    'nome' => $nome,
                    'sobrenome' => $sobrenome,
                    'email' => $email,
                    'telefone' => $telefone,
                    'endereco' => $endereco,
                    'cidade' => $cidade,
                    'cep' => $cep,
                    'data_nascimento' => $data_nascimento,
                );


            } else {
                // Insert data into the database
                $sql = "INSERT INTO contacts (nome, sobrenome, email, telefone, endereco, cidade, cep, data_nascimento, campaing_id) 
                        VALUES ('$nome', '$sobrenome', '$email', '$telefone', '$endereco', '$cidade', '$cep', '$data_nascimento', '$campain_id')";

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
            'invalidPhoneData' => $invalidPhoneData
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
