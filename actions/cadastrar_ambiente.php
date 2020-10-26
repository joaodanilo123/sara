<?php

include '../config/conexao.php';

$nome = $_POST['nome'];
$numero = $_POST['numero'];
$tipo_ambiente_id = $_POST['tipoa'];
$predio = $_POST['predio'];
$id = uniqid();

try {
	$query = $connection->prepare("INSERT INTO ambiente(ambiente_id, ambiente_nome, ambiente_numero, tipo_ambiente_id, predio_id) 
	VALUES (:id, :nome, :numero, :tipo_ambiente, :predio)");

	$query->bindParam(':id', $id);
	$query->bindParam(':nome', $nome);
	$query->bindParam(':numero', $numero);
	$query->bindParam(':tipo_ambiente', $tipo_ambiente_id);
	$query->bindParam(':predio', $predio);

	$query->execute();
	header('Location: ../painel/admin.php?erro=no');
} catch (PDOException $error) {
	echo $error->getMessage();
	header('Location: ../painel/admin.php?erro=erro');
}

$connection = null;
