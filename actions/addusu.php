<?php
	include '../config/conexao.php';

	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);
	$tipou = $_POST['tipou'];	
	$id = uniqid();	

	$sql = "INSERT INTO usuario (usario_id, userio_nome, userio_email, userio_senha, hierarquia_nome) VALUES ('$id','$nome','$email','$senha','$tipou')";
	$result = $connection->query($sql) or die ("$connection->error<br>$sql");
	$connection->close();
