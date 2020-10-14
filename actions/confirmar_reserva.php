<?php

session_start();

require '../utils/verificarSessao.php';
require '../config/conexao.php';

$reserva_id = $_POST['id'];
$agente = $_SESSION['id'];
$dados = [];
$updateSql = "UPDATE reserva SET reserva_ativa='1', agente_id='$agente' WHERE reserva_id='$reserva_id'";
$searchSql = "SELECT reserva_cor FROM reserva WHERE reserva_id='$reserva_id'";

if ($connection->query($updateSql)) {
    $cor = $connection->query($searchSql)->fetch_assoc()['reserva_cor'];
    $dados['color'] = $cor;
    $dados['ok'] = 1;
    $dados['id'] = $reserva_id;
    
} else {
    $dados['id'] = $reserva_id;
    $dados['ok'] = 0;
    $dados['error'] = $connection->error;
}

echo json_encode($dados);

$connection->close();
