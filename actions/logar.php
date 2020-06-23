<?php
include "../config/conexao.php";

$email = mysqli_escape_string($connection, $_POST['email']);
$senha = md5(mysqli_escape_string($connection, $_POST['senha']));
$submit_button = $_POST['submit_button'];

if (isset($submit_button)) {

    $query = "SELECT * FROM usuario WHERE usuario_email = '$email' AND usuario_senha = '$senha'";
    $result = $connection->query($query) or die($connection->error);

    if ($result->num_rows <= 0) {
        header('Location: ../login.php');;
        die("erro");
    } else {
        $dados = $result->fetch_assoc();

        session_start();
        $_SESSION['email'] = $dados['usuario_email'];
        $_SESSION['id'] = $dados['usuario_id'];
        $_SESSION['nome'] = $dados['usuario_nome'];

        switch ($dados['hierarquia_nome']) {
            case 'admin':
                header('Location: ../painel/admin.php');
                break;
            case 'professor':
                header('Location: ../painel/professor.php');
                break;
            case 'agente':
                header("Location: ../painel/agente.php");
                break;
            default:
                header("../login.php?erro=hierarquia_invalida");
        }
    }
}