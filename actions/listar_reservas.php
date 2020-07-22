<?php

require '../config/conexao.php';

$usuario = isset($_GET['id']) ? $_GET['id'] : null;
$ambiente = isset($_GET['ambiente']) ? $_GET['ambiente'] : null;
$hierarquia = isset($_GET['hierarquia']) ? $_GET['hierarquia'] : null;

$sql = "SELECT * FROM reserva WHERE ";

if ($usuario and $hierarquia) {
    $sql .= $hierarquia == 'agente' ? "agente_id=" : "reservista_id=";
    $sql .= "'$usuario' ";
}

if ($ambiente) {
    $sql .= "AND ambiente_id='$ambiente'";
}

$result = $connection->query($sql);

$eventos = [];

function carregar_prof(string $id){
    global $connection;
    
    $sql = "SELECT usuario_nome FROM usuario WHERE usuario_id = '$id'";
    return $connection->query($sql)->fetch_assoc()['usuario_nome'];
}

while($row = $result->fetch_assoc()){
    $id = $row['reserva_id'];
    $prof = carregar_prof($row['reservista_id']);
    $inicio = $row['reserva_inicio'];
    $fim = $row['reserva_fim'];
    $cor = $row['reserva_cor'];

    $eventos[] = [
        'id' => $id,
        'title' => $prof,
        'end' => $inicio,
        'start' => $fim,
        'color' => $cor,
    ];
}

echo json_encode($eventos);