<?php

include '../config/conexao.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$numero = $_POST['numero'];
$tipo_ambiente_id = $_POST['tipoa'];
$predio = $_POST['predio'];
$status = $_POST['status'];
$query = "UPDATE ambiente SET ambiente_nome='$nome', ambiente_numero='$numero', tipo_ambiente_id='$tipo_ambiente_id', predio_id='$predio', ambiente_ativo='$status' WHERE ambiente_id='$id'";
$connection->query($query) or die($connection->error);

if (!$connection->error) {
	header('Location: ../painel/admin.php?erro=no');
} else {
	header('Location: ../painel/admin.php?erro=erro');
}
