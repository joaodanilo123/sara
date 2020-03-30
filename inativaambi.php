<?php
	header ('Content-type: text/html; charset=UTF-8');
	//captura o id repassado pela URL
    $id = $_GET['id'];
	/*Conexão*/
	//$dbc = mysqli_connect('localhost', 'root', 'usbw', 'tcc') or die ('Erro ao conectar ao servidor MySQL');
  	$dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die ('Erro ao conectar ao Banco de Dados');
    mysqli_set_charset($dbc,"utf8");
  	/*instrução*/
    $query = "SELECT * FROM ambiente WHERE id_ambi='$id'";
	/*execução da instrução*//*$dbc = onde -- $query = o que*/
    $result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');
    $row = mysqli_fetch_assoc($result);

    if ($row['inativo'] == 0) {
    	$query2 = "UPDATE ambiente SET `inativo` = '1' WHERE id_ambi='$id'";
    	$result2 = mysqli_query($dbc, $query2) or die ('Erro ao executar o comando SQL2');
    	echo '<p style="text-align: center;">O ambiente foi inativado com sucesso!</p>';
		echo '<meta http-equiv="refresh" content="1;URL=indexadm.php" />';
    }elseif ($row['inativo'] == 1) {
    	$query3 = "UPDATE ambiente SET `inativo` = '0' WHERE id_ambi='$id'";
    	$result3 = mysqli_query($dbc, $query3) or die ('Erro ao executar o comando SQL3');
    	echo '<p style="text-align: center;">O ambiente foi ativado com sucesso!</p>';
		echo '<meta http-equiv="refresh" content="1;URL=indexadm.php" />';
    }
    mysqli_close($dbc);
?>