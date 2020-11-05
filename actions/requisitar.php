<?php

session_start();

require '../utils/verificarSessao.php';
require '../utils/buildUrl.php';

$valid_request = true;

if ($valid_request) {

    require '../config/conexao.php';

    $id = uniqid();
    $prof = $_SESSION['id'];
    $amb = $_POST['ambiente'];
    $i = $_POST['inicio'];
    $f = $_POST['fim'];
    $cor = $_POST['color'];
    $descricao = $_POST['descricao'];


    $sql = "INSERT INTO reserva(reserva_id, ambiente_id, reservista_id, reserva_inicio, reserva_fim, reserva_cor, reserva_ativa, reserva_descricao) VALUES
        (
            :id, 
            :amb,
            :prof,
            :i,
            :f,
            :cor,
            '0',
            :dsc
        )
    ";

    try {
        
        $query = $connection->prepare($sql);
        $query->bindParam(':id', $id);
        $query->bindParam(':amb', $amb);
        $query->bindParam(':prof', $prof);
        $query->bindParam(':i', $i);
        $query->bindParam(':f', $f);
        $query->bindParam(':cor', $cor);
        $query->bindParam(':dsc', $descricao);

        $query->execute();
        
        header("Location: ../painel/professor.php?page=reserva&ambiente=$amb");
    
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
} else {
    header('Location: ../painel/professor.php?invalid_params=1');
}
