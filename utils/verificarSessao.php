<?php

if (!isset($_SESSION['id'], $_SESSION['nome'], $_SESSION['email'], $_SESSION['hierarquia'])) {
    header('Location: ../login.php');
    exit();
}
