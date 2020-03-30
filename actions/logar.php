<?php
header("Content-type: text/html;charset=utf-8");
include "../config/conexao.php";

$email = mysqli_escape_string($connection, $_POST['email']);
$senha = mysqli_escape_string($connection, md5($_POST['senha']));
$entrar = $_POST['entrar'];

if (isset($entrar)) {

    $query = "SELECT * FROM usuario WHERE user_email = '$email' AND user_senha = '$senha'";
    $result = $connection->query($query) or die($connection->error);

    if ($result->num_rows <= 0) {
        echo "senha incorreta";
        die();
    } else {
		$dados = $result->fetch_assoc();
		
        if ($dados['user_inativo'] == 0) {
            //inicia a sessão
            session_start();
            //salva os dados na sessão
            $_SESSION['email'] = $dados['user_email'];
            $_SESSION['id'] = $dados['user_id'];
            $_SESSION['nome'] = $dados['user_nome'];

			//$nomecompleto = $dados['nome']." ".$dados['sobrenome'];
			
			switch ($dados['user_hierarquia']) {
				case 1:
					header("Location: ../indexadm.php");
					break;
				case 2:
					header("Location: ../indexprof.php");
					break;
				case 3:
					header("Location: ../indexap.php");
					break;
				default:
					header("../login.php?erro=hierarquia_invalida");
			}

        } else {
            echo '<p style="text-align: center;">Você foi inativado!</p>';
            echo '<meta http-equiv="refresh" content="1;URL=login.php" />';
        }
    }
}
