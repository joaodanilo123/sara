<?php

$host = 'localhost';
$user = 'root';
$password = '';

try {
    $connection = new PDO("mysql:host=$host;dbname=sara", $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
}


//$connection = new mysqli("localhost", "jdzd", "123", "sara"); 
//$connection->set_charset('utf8');
