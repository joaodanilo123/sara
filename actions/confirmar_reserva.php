<?php

session_start();

require '../utils/verificarSessao.php';
require '../config/conexao.php';

$reserva_id = $_POST['id'];
$agente = $_SESSION['id'];
$dados = [];
$updateSql = "UPDATE reserva SET reserva_ativa=1, agente_id= :agt WHERE reserva_id= :rsv";
$searchSql = "SELECT reserva_cor FROM reserva WHERE reserva_id= ? ";

$query = $connection->prepare($updateSql);
$query->bindParam(':agt', $agente);
$query->bindParam(':rsv', $reserva_id);

$searchQuery = $connection->prepare($searchSql);
$searchQuery->execute([$reserva_id]);

if ($query->execute()) {
    $cor = $searchQuery->fetch()['reserva_cor'];
    $dados['color'] = $cor;
    $dados['ok'] = 1;
    $dados['id'] = $reserva_id;
    
} else {
    $dados['id'] = $reserva_id;
    $dados['ok'] = 0;
    $dados['error'] = $connection->error;
}

echo json_encode($dados);

$connection = null;
