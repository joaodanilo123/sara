<?php
	session_start();

	//$dbc = mysqli_connect('localhost', 'root', 'usbw', 'tcc') or die ('Erro ao conectar ao servidor MySQL');
	$dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die ('Erro ao conectar ao Banco de Dados');
	mysqli_set_charset($dbc,"utf8");
	$idambi = $_POST['idambi'];
	$id = $_POST['id'];
	$idus = $_POST['idus'];
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$reservista = $_POST['reservista'];

	$query2 = "SELECT * FROM usuarios WHERE id_usua = '$idus'";
    $result2 = mysqli_query($dbc, $query2) or die ('Erro ao executar o comando SQL2');
    $row2 = mysqli_fetch_assoc($result2);

	$query3 = "SELECT * FROM reservar WHERE id_rese = '$id'";
    $result3 = mysqli_query($dbc, $query3) or die ('Erro ao executar o comando SQL2');
    $row3 = mysqli_fetch_assoc($result3);

	if (!empty($title) && !empty($start) && !empty($end)) {
		//Converter a data e hora do formato brasileiro para o formato do Banco de Dados
		$data = explode(" ", $start);
		list($date, $hora) = $data;
		$data_sem_barra = array_reverse(explode("/", $date));
		$data_sem_barra = implode("-", $data_sem_barra);
		$start_sem_barra = $data_sem_barra . " " . $hora;
		
		$data = explode(" ", $end);
		list($date, $hora) = $data;
		$data_sem_barra = array_reverse(explode("/", $date));
		$data_sem_barra = implode("-", $data_sem_barra);
		$end_sem_barra = $data_sem_barra . " " . $hora;
		
		if ($row2['id_usua'] == $row3['id_usua']) {
			$result_events = "UPDATE reservar SET `title` = '$title', `start` = '$start_sem_barra', `end` = '$end_sem_barra', `reservista` = '$reservista' WHERE id_rese='$id'";
			$resultado_events = mysqli_query($dbc, $result_events);

			//Verificar se salvou no banco de dados através "mysqli_insert_id" o qual verifica se existe o ID do último dado inserido
			if(mysqli_insert_id($dbc)){ 
				$_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Reserva Cadastrada com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
				header("Location: index.php?id=".$idambi);
			}else{
				$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar a reserva <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
				header("Location: index.php?id=".$idambi);
			}
			}else{
				$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar a reserva <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
			header("Location: index.php?id=".$idambi);
			}
		}else{
	    	echo '<p style="text-align: center;">Você não pode excluí-la!</p>';
	    	echo "<meta http-equiv='refresh' content='1;URL=index.php?id=". $idambi ."' />";
		}
		
?>