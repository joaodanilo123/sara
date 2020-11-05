<?php

include '../config/conexao.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$numero = $_POST['numero'];
$tipo_ambiente_id = $_POST['tipoa'];
$predio = $_POST['predio'];
$status = $_POST['status'];

try {
	$sql ="UPDATE ambiente SET 
			ambiente_nome=:nome, 
			ambiente_numero=:numero, 
			tipo_ambiente_id=:tpi, 
			predio_id=:predio, 
			ambiente_ativo= :stts 
			WHERE ambiente_id=:id";

	$query = $connection->prepare($sql);
	$query->bindParam(':nome', $nome);
	$query->bindParam(':numero', $numero);
	$query->bindParam(':tpi', $tipo_ambiente_id);
	$query->bindParam(':predio', $predio);
	$query->bindParam(':stts', $status);
	$query->bindParam(':id', $id);

	$query->execute();


} catch (PDOException $e) {
	echo $e->getMessage();
	header('Location: ../painel/admin.php?erro=erro');
	exit();
}

header('Location: ../painel/admin.php?erro=no');
