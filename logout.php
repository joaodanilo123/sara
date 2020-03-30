<?php
	//inicia a sessão
	session_start();
	//destroi a sessão
	unset ($_SESSION['login']);
	unset ($_SESSION['id']);
	unset ($_SESSION['nome']);
	session_destroy();
	//redireciona
	header("Location:login.php");exit;
?>