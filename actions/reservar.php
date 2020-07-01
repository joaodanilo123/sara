<?php
require '../config/conexao.php';
session_start();

$id = uniqid();
$prof = $_POST['professor'];
$amb = $_POST['ambiente'];
$agente = $_SESSION['id'];
$i = $_POST['inicio'];
$f = $_POST['fim'];
$cor = $_POST['color'];


$sql = "INSERT INTO reserva(reserva_id, ambiente_id, reservista_id, agente_id, reserva_inicio, reserva_fim, reserva_cor) VALUES
    (
        '$id', 
        '$amb',
        '$prof',
        '$agente',
        '$i',
        '$f',
        '$cor'
    )
";

if($connection->query($sql)){
    header('Location: ../painel/agente.php');
} else {
    echo $connection->error;
};
