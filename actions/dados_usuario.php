<?php

require "../config/conexao.php";

$user = $_GET['id'];

$query = $connection->prepare("SELECT * FROM usuario WHERE usuario_id = :user");
$query->bindParam(':user', $user);
$query->execute();

if($query->rowCount() <= 0){
    $connection = null;
    exit();
}

$data = $query->fetch();

?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <tr>
        <th>Nome</th>
        <td><?=$data['usuario_nome']?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?=$data['usuario_email']?></td>
    </tr>
    <tr>
        <th>ID</th>
        <td><?=$data['usuario_id']?></td>
    </tr>
    <tr>
        <th>Tipo de usuário</th>
        <td><?=$data['hierarquia_nome']?></td>
    </tr>
    <tr>
        <th>Token</th>
        <td><?=$data['usuario_token']?></td>
    </tr>
</table>