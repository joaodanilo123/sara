<?php

if (isset($_SESSION['hierarquia'])) {
    switch ($_SESSION['hierarquia']) {
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
} else {
    header('Location: ./login.php');
}
