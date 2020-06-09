<?php
include "../config/conexao.php";

$email = mysqli_escape_string($connection, $_POST['email']);
$senha = md5(mysqli_escape_string($connection, $_POST['senha']));
$submit_button = $_POST['submit_button'];

if (isset($submit_button)) {

    $query = "SELECT * FROM usuario WHERE user_email = '$email' AND user_senha = '$senha'";
    $result = $connection->query($query) or die($connection->error);

    if ($result->num_rows <= 0) {
        header('Location: ../login.php');;
        die("erro");
    } 
    
    
    else {
		$dados = $result->fetch_assoc();
		
        if ($dados['user_inativo'] == 0) {
            
            session_start();
            $_SESSION['email'] = $dados['user_email'];
            $_SESSION['id'] = $dados['user_id'];
            $_SESSION['nome'] = $dados['user_nome'];


            
			switch ($dados['hierarquia_nome']) {
				case 'admin':
					header('Location: http://sara.net/painel/admin');
					break;
				case 'professor':
                    header('Location: http://sara.net/painel/professor');
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
