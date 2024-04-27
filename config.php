<?php
function getdb(){
$servername = "localhost";
$username = "root";
$password = "";
$db = "contact_manager";
try {
   
    $conn = mysqli_connect($servername, $username, $password, $db);
    //  echo "Connected successfully"; 
     //command to see logs at 
    error_log("Connected successfully");
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
echo "Connected successfully";
?>