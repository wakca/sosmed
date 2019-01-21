<?php
$servername = "localhost";
$username = "klipaa_coba";
$password = "tahun2019";
$db = 'klipaa_coba';

    $conn = new mysqli($servername, $username, $password, $db);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

?>