<?php

require_once '../config/conexao.php';

$sql = "SELECT usuario_token token, usuario_nome name FROM usuario WHERE hierarquia_nome='professor'";
$tags = $connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($tags);
