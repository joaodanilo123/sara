<?php
	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$user = $_POST['user'];
	$senha = $_POST['senha'];
	$tipou = $_POST['tipou'];

	//$dbc = mysqli_connect('localhost', 'root', 'usbw', 'tcc') or die ('Erro ao conectar ao servidor MySQL');
	$dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die ('Erro ao conectar ao Banco de Dados');
	mysqli_set_charset($dbc,"utf8");
	$query = "UPDATE usuarios SET `nome` = '$nome', `sobrenome` = '$sobrenome', `email` = '$email', `user` = '$user', `senha` = '$senha', `id_tipo_usua` = '$tipou' WHERE id_usua='$id'";
	$result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');
	mysqli_close($dbc);
	echo '<p style="text-align: center;">O Registro '. $id . ' Foi alterado com sucesso!</p>';
	echo '<meta http-equiv="refresh" content="1;URL=listausu.php" />';
?>