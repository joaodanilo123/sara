<?php

require '../config/conexao.php';

$rfid = $_POST['rfid'];

$sql = "SELECT reserva_finalizada, reserva_iniciada, reserva_id FROM reserva 
        INNER JOIN usuario ON reserva.reservista_id = usuario.usuario_id 
        WHERE usuario.usuario_token = '$rfid' AND reserva_ativa = 1 AND reserva_finalizada IS NULL   
        ORDER BY reserva_inicio LIMIT 1 ";

try {
    $data = $connection->query($sql)->fetch();
} catch (PDOException $e) {
    echo jsonn_encode(['message' => $e->getMessage()]);
    http_response_code(500);
    exit();
}

if(!$data){
    echo json_encode(['message' => 'Usuário não encontrado ou sem reservas pendentes']);
    exit();
}

$id = $data['reserva_id'];
$now = date(DATE_RFC3339);

if($data['reserva_iniciada'] == null) {
    $sql = "UPDATE reserva SET reserva_iniciada = '$now' WHERE reserva_id = '$id'";
    $message = 'reserva iniciada';
} elseif ($data['reserva_finalizada'] == null ) {
    $sql = "UPDATE reserva SET reserva_finalizada = '$now' WHERE reserva_id = '$id'";
    $message = 'reserva finalizada';
} else {
    $connection = null;
    echo 'ERRO na atualização do status da reserva.';
    exit();
}

try {
    $connection->query($sql);
    echo json_encode(['message' => $message]);
} catch (PDOException $e) {
    http_response_code(500);
    echo  json_encode(['message' => 'ERRO no banco de dados: '.$e->getMessage()]);
    exit();
}
