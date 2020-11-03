<?php
include "../config/conexao.php";

$email = $_POST['email'];
$password = md5($_POST['senha']);
$submit_button = $_POST['submit_button'];

if (isset($submit_button)) {

    $query = $connection->prepare("SELECT * FROM usuario WHERE usuario_email = :email AND usuario_senha = :pwd");
    $query->bindParam(':email', $email);
    $query->bindParam(':pwd', $password);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $result = $query->fetch();
    
    if ($query->rowCount() <= 0) {
        header('Location: ../login.php');;
        die("erro");
    } else {

        session_start();
        $_SESSION['email'] = $result['usuario_email'];
        $_SESSION['id'] = $result['usuario_id'];
        $_SESSION['nome'] = $result['usuario_nome'];
        $_SESSION['hierarquia'] = $result['hierarquia_nome'];

        switch ($result['hierarquia_nome']) {
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