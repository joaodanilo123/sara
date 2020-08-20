<?php

require '../config/conexao.php';

$ambiente = $_GET['ambiente'];

$sql = "SELECT reserva_inicio, reserva_fim FROM reserva WHERE ambiente_id = '$ambiente'";
$result = $connection->query($sql);
$stamps = [];

while($row = $result->fetch_assoc()) {
    array_push($stamps, [$row['reserva_inicio'], $row['reserva_fim']]);
}


echo json_encode($stamps);