<?php
	include '../config/conexao.php';

	print_r($_POST);

	$nome = $_POST['nome'];
	$numero = $_POST['numero'];
	$tipo_ambiente_id = $_POST['tipoa'];
	$predio = $_POST['predio'];
	$id = uniqid();
	$query = "INSERT INTO ambiente(ambiente_id, ambiente_nome, ambiente_numero, tipo_ambiente_id, predio_id) VALUES ('$id','$nome', '$numero', '$tipo_ambiente_id', '$predio')";
	$connection->query($query) or die($connection->error);
	
	if (!$connection->error) {
		header('Location: ../painel/admin.php?erro=no');
	} else {
		header('Location: ../painel/admin.php?erro=erro');
	}
