<?php

session_start();

require '../utils/verificarSessao.php';
require '../config/conexao.php';

$id = uniqid();
$prof = $_POST['professor'];
$amb = $_POST['ambiente'];
$agente = $_SESSION['id'];
$i = $_POST['inicio'];
$f = $_POST['fim'];
$cor = $_POST['color'];
$descricao = $_POST['descricao'];


try {
    $sql = "INSERT INTO reserva(reserva_id, ambiente_id, reservista_id, agente_id, reserva_inicio, reserva_fim, reserva_cor, reserva_ativa, reserva_descricao) VALUES
        (
            :id, 
            :amb,
            :prof,
            :agente,
            :i,
            :f,
            :cor,
            '1',
            :dsc
        )";

    $query = $connection->prepare($sql);
    $query->bindParam(':id', $id);
    $query->bindParam(':amb', $amb);
    $query->bindParam(':prof', $prof);
    $query->bindParam(':agente', $agente);
    $query->bindParam(':i', $i);
    $query->bindParam(':f', $f);
    $query->bindParam(':cor', $cor);
    $query->bindParam(':dsc', $descricao);
    $query->execute();
    
    header("Location: ../painel/agente.php?page=reserva&ambiente=$amb");

} catch (PDOException $e) {
    echo $e->getMessage();
}

$connection = null;