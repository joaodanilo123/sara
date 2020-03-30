<?php
	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$user = $_POST['user'];
	$senha = $_POST['senha'];

	//$dbc = mysqli_connect('localhost', 'root', 'usbw', 'tcc') or die ('Erro ao conectar ao servidor MySQL');
	$dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die ('Erro ao conectar ao Banco de Dados');
	mysqli_set_charset($dbc,"utf8");
	$query = "UPDATE usuarios SET `nome` = '$nome', `sobrenome` = '$sobrenome', `email` = '$email', `user` = '$user', `senha` = '$senha' WHERE id_usua='$id'";
	$result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');
	
	echo '<p style="text-align: center;">O Registro '. $id . ' Foi alterado com sucesso!</p>';

	$query2 = "SELECT * FROM usuarios WHERE id_usua='$id'";
	$result2 = mysqli_query($dbc, $query2) or die ('Erro ao executar o comando SQL');
    $row = mysqli_fetch_array($result2);
    if ($row['id_tipo_usua'] == 1) {
    	header("Location:mdprof.php");
    }elseif ($row['id_tipo_usua'] == 3) {
		header("Location:mdap.php");
	}
	mysqli_close($dbc);
?>