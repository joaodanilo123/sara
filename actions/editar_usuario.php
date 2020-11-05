<?php

session_start();

require '../utils/verificarSessao.php';
require '../utils/buildUrl.php';
require '../utils/validateParams.php';
require '../utils/validateEmail.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $messages = [];
    $params = ['nome', 'id', 'hierarquia'];

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $hierarquia = $_POST['hierarquia'];
    $token = isset($_POST['token']) ? $_POST['token'] : '';
    $senha = $_POST['senha'];
    $id = $_POST['id'];

    $paramsValid = validateParams($params, $_POST, true);
    $emailValid = validateEmail($email);
    $tokenValid = validateToken($token, $hierarquia);

    if (!$emailValid) array_push($messages, 'Email inválido');
    if (!$tokenValid) array_push($messages, 'Token inválido');

    if ($paramsValid and $emailValid and $tokenValid) {

        $sql = buildSql();
        executeUpdate($sql);
        header(buildUrl($messages));

    } else {
        header(buildUrl($messages));
        exit();
    }
}


function validateToken($token, $hierarquia)
{
    return !empty($token) and $hierarquia == 'professor';
}

function buildSql()
{

    global $nome, $token, $id, $hierarquia, $email;

    $sql = "UPDATE usuario SET 
            usuario_nome=:nome,
            usuario_email=:email,
            hierarquia_nome=:hrq
            ";

    if ($hierarquia == 'professor') {
        $sql .= ",usuario_token=:tkn";
    }

    if (!empty($senha)) {
        $senha = md5($senha);
        $sql .= ",usuario_senha=:senha";
    }

    $sql .= " WHERE usuario_id=:id";

    return $sql;
}

function executeUpdate($sql)
{
    global $messages;
    global $nome, $token, $id, $hierarquia, $email;
    require '../config/conexao.php';

    $query = $connection->prepare($sql);

    $query->bindParam(':nome', $nome);
    $query->bindParam(':tkn', $token);
    $query->bindParam(':email', $email);
    $query->bindParam(':id', $id);
    $query->bindParam(':hrq', $hierarquia);

    if ($query->execute()) {
        array_push($messages, 'Dados atualizados com sucesso');
    } else {
        array_push($messages, "Não foi possível atualizar os dados: {$connection->error}");
    };

    $connection = null;
}
