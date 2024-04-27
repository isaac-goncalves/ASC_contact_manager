<?php
require_once 'config.php';

if (isset($_POST["Import"])) {

    $con = getdb();

    $filename = $_FILES["fileInput"]["tmp_name"];
    $campaign = $_POST['campaign'];

    if( $campaign == "" ){
        echo "<script type=\"text/javascript\">
        alert(\"Por favor, insira o nome da campanha.\");
        window.location = \"index.php\"
        </script>";
        exit();
    }

    if( $filename == ""){
        echo "<script type=\"text/javascript\">
        alert(\"Por favor, selecione um arquivo CSV.\");
        window.location = \"index.php\"
        </script>";
        exit();
    }

    if ($_FILES["fileInput"]["size"] > 0) {
        $file = fopen($filename, "r");

        error_log("Amount of rows in csv is "); 
       

        while (($getData = fgetcsv($file, 100000, ";")) !== false) {
            // Convert data to UTF-8
            $getData = array_map('utf8_encode', $getData);

            // Assuming $conn is your MySQL database connection
            $nome = $getData[0]; // Assuming the first column contains Nome
            $sobrenome = $getData[1]; // Assuming the second column contains Sobrenome
            $email = $getData[2]; // Assuming the third column contains Email
            $telefone = $getData[3]; // Assuming the fourth column contains Telefone
            $endereco = $getData[4]; // Assuming the fifth column contains Endereço
            $cidade = $getData[5]; // Assuming the sixth column contains Cidade
            $cep = $getData[6]; // Assuming the seventh column contains CEP
            $data_nascimento = $getData[7]; // Assuming the eighth column contains Data de Nascimento


            

            // Insert data into the database
            $sql = "INSERT INTO contacts (nome, sobrenome, email, telefone, endereco, cidade, cep, data_nascimento) 
                    VALUES ('$nome', '$sobrenome', '$email', '$telefone', '$endereco', '$cidade', '$cep', '$data_nascimento')";

            $result = mysqli_query($con, $sql);

            if (!isset($result)) {
                echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.location = \"index.php\"
              </script>";
            } else {
                echo "<script type=\"text/javascript\">
            alert(\"CSV File has been successfully Imported.\");
            window.location = \"index.php\"
          </script>";
            }
        }

        fclose($file);
    }
} else
    echo "Não foi possível importar o arquivo CSV";
