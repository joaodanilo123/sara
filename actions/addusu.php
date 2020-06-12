<?php
	include '../config/conexao.php';

	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);
	$tipou = $_POST['tipou'];	
	$id = uniqid();	

	$sql = "INSERT INTO usuario (usuario_id, usuario_nome, usuario_email, usuario_senha, hierarquia_nome) VALUES ('$id','$nome','$email','$senha','$tipou')";
	$result = $connection->query($sql) or die ("$connection->error<br>$sql");
	$connection->close();

	header('Location: ../painel/admin.php');


