<?php
	include '../config/conexao.php';

	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$user = $_POST['user'];
	$senha = $_POST['senha'];
	$tipou = $_POST['tipou'];	
	$id = uniqid();	

	$sql = "INSERT INTO usuario (user_id, user_nome, user_email, user_senha, hierarquia_nome) VALUES ('$id','$nome','$email','$senha','$tipou')";
	$result = $connection->query($sql) or die ('Erro ao executar o comando SQL');
	$connection->close();
	
?>