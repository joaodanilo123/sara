<?php

session_start();

require '../utils/verificarSessao.php';

$messages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $hierarquia = $_POST['hierarquia'];
    $token = isset($_POST['token']) ? $_POST['token'] : '';
    $senha = $_POST['senha'];
    $id = $_POST['id'];

    if (validateParams()) {

        $sql = buildSql();
        echo $sql;
        executeUpdate($sql);
        header(buildUrl());

    } else {
        header(buildUrl());
        exit();
    }
}


function validateParams()
{

    global $nome, $token, $id, $hierarquia, $email;
    global $messages;

    $valid = true;

    if (empty($nome)) {
        array_push($messages, 'Nome inválido');
        $valid = false;
    }

    if (empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($messages, 'email inválido');
        $valid = false;
    }

    if (empty($hierarquia)) {
        array_push($messages, 'Tipo de usuário inválido');
        $valid = false;
    }

    if (empty($token) and $hierarquia == 'professor') {
        array_push($messages, 'Token inválido');
        $valid = false;
    }

    if (empty($id)) {
        array_push($messages, 'Usuário não existe');
        $valid = false;
    }

    return $valid;
}

function buildUrl()
{
    global $messages;
    $messagesUrl = http_build_query(array('messages' => $messages));
    $url = "location: ../painel/admin.php?$messagesUrl";
    return $url;
}

function buildSql()
{

    global $nome, $token, $id, $hierarquia, $email;

    $sql = "UPDATE usuario SET 
            usuario_nome='$nome',
            usuario_email='$email',
            hierarquia_nome='$hierarquia'
            ";

    if ($hierarquia == 'professor') {
        $sql .= ",usuario_token='$token'";
    }

    if (!empty($senha)) {
        $senha = md5($senha);
        $sql .= ",usuario_senha='$senha'";
    }

    $sql .= " WHERE usuario_id='$id'";

    return $sql;
}

function executeUpdate($sql)
{
    global $messages;

    require '../config/conexao.php';

    if ($connection->query($sql)) {
        array_push($messages, 'Dados atualizados com sucesso');
    } else {
        array_push($messages, "Não foi possível atualizar os dados: {$connection->error}");
    };

    $connection->close();
}
