<?php

require "../config/conexao.php";


$user = $_POST['id'];

$sql = "SELECT * FROM usuario WHERE usuario_id = '$user'";
$data = $connection->query($sql)->fetch_assoc();

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
</table>