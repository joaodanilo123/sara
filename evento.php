<?php
	session_start();

	//$dbc = mysqli_connect('localhost', 'root', 'usbw', 'tcc') or die ('Erro ao conectar ao servidor MySQL');
	$dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die ('Erro ao conectar ao Banco de Dados');
	mysqli_set_charset($dbc,"utf8");
	$iduser = $_POST['iduser'];
	$idambi = $_POST['idambi'];
	$title = $_POST['title'];
	$color = $_POST['color'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$reservista = $_POST['reservista'];
	//$rep = $_POST['rep'];
	$rep = 0;

	

	if (!empty($title) && !empty($color) && !empty($start) && !empty($end)) {
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

		//date_default_timezone_set('America/Sao_Paulo');
		//$dt = new DateTime($start);
		//$dtend = new DateTime($end);
	   	//$dt->modify('-1 week');//para inserir a semana atual
	    //for ($i=1;$i<=$rep; $i++){
	    $result_events = "INSERT INTO reservar (title, color, start, end, id_usua, id_ambi, reservista, repeticao) VALUES ('$title', '$color', '$start_sem_barra', '$end_sem_barra', '$iduser', '$idambi', '$reservista', '$rep')";
	    	
	    //}
	    //$tes = $data->format('Y-m-d h:i:s')."<br/>";
		
		
		//echo $result_events;
		//exit;
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
?>