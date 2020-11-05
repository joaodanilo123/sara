<?php

require '../config/conexao.php';

$ambiente = $_GET['ambiente'];

$sql = "SELECT reserva_inicio, reserva_fim FROM reserva WHERE ambiente_id = ?";
$query = $connection->prepare($sql);
$query->execute([$ambiente]);
$result = $query->fetchAll();
$stamps = [];

foreach($result as $row) {
    array_push($stamps, [$row['reserva_inicio'], $row['reserva_fim']]);
}

echo json_encode($stamps);