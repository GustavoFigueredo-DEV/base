<?php  
$host = "localhost";
$dbname = "assistencia";
$user = "root";
$password = "root";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Falha de conexão". $conn->connect_error);
}

?>