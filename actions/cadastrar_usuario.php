<?php
	require '../config/conexao.php';
	
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);
	$tipou = $_POST['tipou'];
	$token = $tipou == 'professor' ? $_POST['token'] : '0000000000';
	$id = uniqid();	

	$sql = "INSERT INTO usuario (usuario_id, usuario_nome, usuario_email, usuario_senha, hierarquia_nome, usuario_token) VALUES ('$id','$nome','$email','$senha','$tipou', '$token')";
	$result = $connection->query($sql) or die ("$connection->error<br>$sql");
	$connection->close();

	header('Location: ../painel/admin.php?message=Usuário+cadastrado+com+sucesso');


