<?php
	header("Content-type: text/html; charset=utf-8");

	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$user = $_POST['user'];
	$senha = $_POST['senha'];
	$tipou = $_POST['tipou'];		

	/*Conexão ao banco de dados*/
	//$dbc = mysqli_connect('localhost', 'root', 'usbw', 'tcc') or die ('Erro ao conectar ao servidor MySQL'); 
	$dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die ('Erro ao conectar ao Banco de Dados');
	mysqli_set_charset($dbc,"utf8");
	/*instrução a ser executada no banco de dados*/
	$query = "INSERT INTO usuarios (nome, sobrenome, email, user, senha, id_tipo_usua) VALUES ('$nome', '$sobrenome', '$email', '$user', '$senha', '$tipou')";
	/*execução da instrução no banco de dados*/
	/*$dbc = onde -- $query = o que*/
	$result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');
	/*encerramento da conexão*/
	mysqli_close($dbc);
	/*retorno da tela de listagem*/
	echo '<p style="text-align: center;">O Usuário '.$nome." ".$sobrenome. ' foi adicionado com sucesso!</p>';
    echo'<meta http-equiv="refresh" content="1;URL=listausu.php" />';
?>