<?php
require '../config/conexao.php';
session_start();

$params = ['professor', 'ambiente', 'inicio', 'fim', 'color'];
$valid_request = true;

foreach ($params as $p) {
    if (!isset($_POST[$p])) {
        $valid_request = false;
        break;
    }
}

if ($valid_request) {
    $id = uniqid();
    $prof = $_POST['professor'];
    $amb = $_POST['ambiente'];
    $agente = $_SESSION['id'];
    $i = $_POST['inicio'];
    $f = $_POST['fim'];
    $cor = $_POST['color'];


    $sql = "INSERT INTO reserva(reserva_id, ambiente_id, reservista_id, agente_id, reserva_inicio, reserva_fim, reserva_cor) VALUES
        (
            '$id', 
            '$amb',
            '$prof',
            '$agente',
            '$i',
            '$f',
            '$cor'
        )
    ";

    if ($connection->query($sql)) {
        header("Location: ../painel/agente.php?page=reserva&ambiente=$amb");
    } else {
        echo $connection->error;
    };
} else {
    header('Location: ../painel/agente.php?invalid_params=1');
}
