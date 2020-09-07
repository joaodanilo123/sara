<?php

require '../config/conexao.php';

$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$id = uniqid();

if (!empty($nome)) {
    $sql = "INSERT INTO predio(predio_id, predio_nome) VALUES ('$id','$nome')";
    if ($connection->query($sql)) {
        header('Location: ../painel/admin.php?message=Prédio+cadastrado+com+sucesso');
    }
}
