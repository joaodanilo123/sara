<?php
include '../config/conexao.php';

$sql = "SELECT * FROM predio";
$result = $connection->query($sql)->fetchAll();
$connection = null;

?>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <tr>
            <td><b>ID</b></td>
            <td><b>Nome</b></td>
            <td style="width: 10%;"><b>Opções</b></td>
        </tr>
        <?php foreach($result as $row) : ?>
            <tr>
                <td><?= $row['predio_id'] ?></td>
                <td><?= $row['predio_nome'] ?></td>
                <td style="text-align:center">
                    <a href="#" title="Editar Prédio" onclick="loadBuildingEditForm('<?= $row['predio_id'] ?>')" class="opcao">✏️</a>
                    <a href="#" title="Ver ambientes" onclick="loadBuildingEnvs('<?= $row['predio_id'] ?>')" class="opcao">🔍</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>