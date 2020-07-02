<?php
require '../config/conexao.php';
session_start();
$agente = $_SESSION['id'];
$sql = "SELECT reserva_id, reservista_id, reserva_inicio, reserva_fim, reserva_cor FROM reserva WHERE agente_id='$agente'";
$result = $connection->query($sql);

$eventos = [];

function carregar_prof(string $id)
{
    global $connection;

    $sql = "SELECT usuario_nome FROM usuario WHERE usuario_id = '$id'";
    return $connection->query($sql)->fetch_assoc()['usuario_nome'];
}

while ($row = $result->fetch_assoc()) {
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
