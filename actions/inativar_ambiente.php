<?php

require_once '../config/conexao.php';
$id = $_POST['id'];
$sql = "UPDATE ambiente SET ambiente_ativo='não' WHERE ambiente_id = '$id'";

if ($connection->query($sql)){
    $connection->close();
    http_response_code(200);
} else {
    $connection->close();
    http_response_code(500);
};

exit();