<?php

require '../config/conexao.php';

$prof = isset($_GET['prof']) ? $_GET['prof'] : null;
$ambiente =  isset($_GET['ambiente']) ? $_GET['ambiente'] : null;
$agente =  isset($_GET['agente']) ? $_GET['agente'] : null;

$sql = "SELECT * FROM reserva ";

if($prof or $ambiente or $agente){
    $sql .= 'WHERE ';
    
    $sql .= checkParam($prof) ? '' : "reservista_id='$prof' AND ";
    $sql .= checkParam($ambiente) ? '' : "ambiente_id='$ambiente' AND ";
    $sql .= checkParam($agente) ? '' : "agente_id='$agente' AND ";

    $sql .= '1=1';
}

$result = $connection->query($sql);

$eventos = [];

while($row = $result->fetch_assoc()){
    $id = $row['reserva_id'];
    $prof = carregar_prof($row['reservista_id']);
    $inicio = $row['reserva_inicio'];
    $fim = $row['reserva_fim'];
    $cor = $row['reserva_cor'];

    $eventos[] = [
        'id' => $id,
        'title' => $prof,
        'end' => $fim,
        'start' => $inicio,
        'color' => $cor,
        'agente' => $agente
    ];
}

echo json_encode($eventos);

function carregar_prof(string $id){
    global $connection;
    
    $sql = "SELECT usuario_nome FROM usuario WHERE usuario_id = '$id'";
    return $connection->query($sql)->fetch_assoc()['usuario_nome'];
}

function checkParam($p){
    if(empty($p) or $p == 'todos') return true; 
}

$connection->close();