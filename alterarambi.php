<?php
	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$numero = $_POST['numero'];
	$tipoa = $_POST['tipoa'];

	//$dbc = mysqli_connect('localhost', 'root', 'usbw', 'tcc') or die ('Erro ao conectar ao servidor MySQL');
	$dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die ('Erro ao conectar ao Banco de Dados');
	mysqli_set_charset($dbc,"utf8");
	$query = "UPDATE ambiente SET `nome` = '$nome', `numero` = '$numero', `id_tipo_ambi` = '$tipoa' WHERE id_ambi='$id'";
	$result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');
	mysqli_close($dbc);
	echo '<p style="text-align: center;">O Registro '. $id . ' Foi alterado com sucesso!</p>';
	echo '<meta http-equiv="refresh" content="1;URL=indexadm.php" />';
?>