<?php
	header('Content-Type: text/html; charset=UTF-8');

    $id = $_GET['id'];
    $ida = $_GET['ida'];
    $idu = $_GET['idu'];
  
    //$dbc = mysqli_connect('localhost', 'root', 'usbw', 'tcc') or die ('Erro ao conectar ao servidor MySQL');
    $dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die ('Erro ao conectar ao Banco de Dados');
    mysqli_set_charset($dbc,"utf8");
    $query2 = "SELECT * FROM usuarios WHERE id_usua = '$idu'";
    $result2 = mysqli_query($dbc, $query2) or die ('Erro ao executar o comando SQL2');
    $row2 = mysqli_fetch_assoc($result2);

	$query3 = "SELECT * FROM reservar WHERE id_rese = '$id'";
    $result3 = mysqli_query($dbc, $query3) or die ('Erro ao executar o comando SQL2');
    $row3 = mysqli_fetch_assoc($result3);    

    if ($row2['id_usua'] == $row3['id_usua']) {
    	$query = "DELETE FROM reservar WHERE id_rese='$id' LIMIT 1";
    	$result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');

		mysqli_close($dbc);
    	echo '<p style="text-align: center;">A reserva '. $id . ' Foi removida com sucesso!</p>';
    	echo "<meta http-equiv='refresh' content='1;URL=index.php?id=". $ida ."' />";
    }else{
    	mysqli_close($dbc);
    	echo '<p style="text-align: center;">Você não pode excluí-la!</p>';
    	echo "<meta http-equiv='refresh' content='1;URL=index.php?id=". $ida ."' />";
    }
    
?>