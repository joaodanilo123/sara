<?php

session_start();

require '../utils/verificarSessao.php';

$params = ['professor', 'ambiente', 'inicio', 'fim', 'color', 'descricao'];
$valid_request = true;

foreach ($params as $p) {
    if (!isset($_POST[$p])) {
        $valid_request = false;
        break;
    }
}

if ($valid_request) {

    require '../config/conexao.php';

    $id = uniqid();
    $prof = $_POST['professor'];
    $amb = $_POST['ambiente'];
    $agente = $_SESSION['id'];
    $i = $_POST['inicio'];
    $f = $_POST['fim'];
    $cor = $_POST['color'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO reserva(reserva_id, ambiente_id, reservista_id, agente_id, reserva_inicio, reserva_fim, reserva_cor, reserva_ativa, reserva_descricao) VALUES
        (
            '$id', 
            '$amb',
            '$prof',
            '$agente',
            '$i',
            '$f',
            '$cor',
            '1',
            '$descricao'
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
