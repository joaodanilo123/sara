<?php
	require '../config/conexao.php';
	
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);
	$tipou = $_POST['tipou'];
	$token = $tipou == 'professor' ? $_POST['token'] : '0000000000';
	$id = uniqid();	

	$sql = "INSERT INTO usuario (usuario_id, usuario_nome, usuario_email, usuario_senha, hierarquia_nome, usuario_token) 
			VALUES (:id, :nome, :email, :senha, :tipo, :token)";
	
	try {
		$query = $connection->prepare($sql);
		$query->bindParam(':id', $id);
		$query->bindParam(':nome', $nome);
		$query->bindParam(':email', $email);
		$query->bindParam(':senha', $senha);
		$query->bindParam(':tipo', $tipou);
		$query->bindParam(':token', $token);
		$query->execute();

		$connection = null;

	} catch (PDOException $e) {
		$m = $e->getMessage();
		header('Location: ../painel/admin.php?message=' . $m);
	}
	
	header('Location: ../painel/admin.php?message=Usuário+cadastrado+com+sucesso');
