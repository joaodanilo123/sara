<?php
include '../config/conexao.php';

$sql = "SELECT * FROM usuario";
$usuarios = $connection->query($sql)->fetchAll();
$connection = null;

?>

<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <tr>
            <td style="width: 1%;"><b>ID</b></td>
            <td><b>Nome</b></td>
            <td><b>Email</b></td>
            <td><b>Privilégios</b></td>
            <td style="width: 10%;"><b>Opções</b></>
        </tr>

        <?php foreach ($usuarios as $row) : ?>
            <tr>
                <td><?= $row['usuario_id'] ?></td>
                <td><?= $row['usuario_nome'] ?></td>
                <td><?= $row['usuario_email'] ?></td>
                <td><?= $row['hierarquia_nome'] ?></td>
                <td style="text-align:center">
                    <a onclick="loadUserEditForm('<?=$row['usuario_id']?>')" class="opcao">✏️</a>
                    <?php if($row['hierarquia_nome'] == 'professor'):?>
                        <a onclick="loadSearch('todos', '<?=$row['usuario_id']?>', 'todos')" class="opcao">🔍</a>
                    <?php elseif($row['hierarquia_nome'] == 'agente'):?>
                        <a onclick="loadSearch('todos', 'todos', '<?=$row['usuario_id']?>')" class="opcao">🔍</a>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>