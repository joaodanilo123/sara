<?php
	include '../config/conexao.php';

	$nome = $_POST['nome'];
	$numero = $_POST['numero'];
	$tipo_ambiente_id = $_POST['tipoa'];
	$id = uniqid();
	$query = "INSERT INTO ambiente(ambiente_id, ambiente_nome, ambiente_numero, tipo_ambiente_id) VALUES ('$id','$nome', '$numero', '$tipo_ambiente_id')";
	$connection->query($query);
	$connection->close();
	header("Location: ../cadastro/ambiente.php");
