<?php

require '../config/conexao.php';

session_start();

$prof = isset($_GET['prof']) ? $_GET['prof'] : null;
$ambiente =  isset($_GET['ambiente']) ? $_GET['ambiente'] : null;
$agente =  isset($_GET['agente']) ? $_GET['agente'] : null;

$sql = "SELECT * FROM usuario
        INNER JOIN reserva ON reserva.reservista_id = usuario.usuario_id
        INNER JOIN ambiente ON reserva.ambiente_id = ambiente.ambiente_id ";

if($prof or $ambiente or $agente){
    $sql .= 'WHERE ';
    
    $sql .= checkParam($prof) ? '' : "reserva.reservista_id= :prof AND ";
    $sql .= checkParam($ambiente) ? '' : "ambiente.ambiente_id= :amb AND ";
    $sql .= checkParam($agente) ? '' : "reserva.agente_id= :agt AND ";
    if($_SESSION['hierarquia'] != 'agente') "reserva.reserva_ativa='1' AND ";
    $sql .= '1=1';
}

try {

    $query = $connection->prepare($sql);

    if (!checkParam($prof)) {
        $query->bindParam(':prof', $prof);
    }

    if (!checkParam($ambiente)) {
        $query->bindParam(':amb', $ambiente);
    }

    if (!checkParam($agente)) {
        $query->bindParam(':agt', $agente);
    }

    $query->execute();

    $result = $query->fetchAll();

} catch (PDOException $e) {
    echo $e->getMessage().'<br>';
    var_dump($sql);
    exit();
}

$eventos = [];

foreach($result as $evento){
    if($evento['reserva_ativa'] == 0) $evento['reserva_cor'] = '#bcbcbc';
    $eventos[] = [
        'id' => $evento['reserva_id'],
        'prof' => $evento['usuario_nome'],
        'ambiente' => $evento['ambiente_nome'],
        'descricao' => $evento['reserva_descricao'],
        'title' => "{$evento['usuario_nome']}\n{$evento['ambiente_nome']}",
        'end' => $evento['reserva_fim'],
        'start' => $evento['reserva_inicio'],
        'color' => $evento['reserva_cor']
    ];
}

echo json_encode($eventos);

function checkParam($p){
    if(empty($p) or $p == 'todos') return true; 
}
