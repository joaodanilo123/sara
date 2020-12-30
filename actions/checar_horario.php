<?php

require '../config/conexao.php';

//$predio = $_GET['predio'];

$sql = "SELECT * FROM predio p
        INNER JOIN ambiente a ON p.predio_id = a.predio_id  
        INNER JOIN reserva r ON r.ambiente_id = a.ambiente_id
        INNER JOIN usuario u ON u.usuario_id = r.reservista_id
        WHERE r.reserva_ativa = 1";

$dataRaw = $connection->query($sql)->fetchAll();
$data = [];

foreach($dataRaw as $d){

    $reserveDate = date('d/m/Y' , strtotime($d['reserva_inicio']));
    $today = date('d/m/Y');

    if($today == $reserveDate){

        $reserveHourStart = date('H:i' , strtotime($d['reserva_inicio']));
        $reserveHourEnd = date('H:i' , strtotime($d['reserva_fim']));

        if ($d['reserva_iniciada'] != null) {
            $reserveHourStarted = date('H:i' , strtotime($d['reserva_iniciada']));
        } else {
            $reserveHourStarted = false;
        }

        if ($d['reserva_finalizada'] != null) {
            $reserveHourEnded = date
            ('H:i' , strtotime($d['reserva_finalizada']));
        } else {
            $reserveHourEnded = false;
        }

        $data[] = [
            'professor' => $d['usuario_nome'],
            'sala' => $d['ambiente_nome'],
            'predio' => $d['predio_nome'],
            'descricao' => $d['reserva_descricao'],
            'inicio' => $reserveHourStart,
            'fim' => $reserveHourEnd,
            'iniciada' => $reserveHourStarted,
            'finalizada' => $reserveHourEnded
        ];
    }
}

echo json_encode($data);
