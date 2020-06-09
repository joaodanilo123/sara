<?php
	include '../config/conexao.php';

	$nome = $_POST['nome'];
	$numero = $_POST['numero'];
	$tipo_ambiente_id = $_POST['tipoa'];
	$id = uniqid();
	$query = "INSERT INTO ambiente(ambiente_id, ambiente_nome, ambiente_numero, tipo_ambiente_id) VALUES ('$id','$nome', '$numero', '$tipo_ambiente_id')";
	$connection->query($query) or die($connection->error);
	
	if (!$connection->error) {
		header('Location: ../cadastro/ambiente?erro=no');
	} else {
		header('Location: ../cadastro/ambiente?erro=erro');
	}
	//header("Location: ../cadastro/ambiente.php");
