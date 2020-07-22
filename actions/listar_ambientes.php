<?php
include '../config/conexao.php';

$sql = "SELECT * FROM ambiente ORDER BY ambiente_ativo DESC";
$result = $connection->query($sql);
$connection->close();

?>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <tr>
            <td style="width: 1%;"><b>ID</b></td>
            <td><b>Nome</b></td>
            <td><b>Número</b></td>
            <td><b>Ativo</b></td>
            <td style="width: 10%;"><b>Opções</b></td>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['ambiente_id'] ?></td>
                <td><?= $row['ambiente_nome'] ?></td>
                <td style="text-align:center"><?= $row['ambiente_numero'] ?></td>
                <td><?= $row['ambiente_ativo'] ?></td>
                <td style="text-align:center">
                    <?php if($row['ambiente_ativo'] == 'sim'): ?>
                        <a href="#" title="Inativar" onclick="inativateEnv('<?= $row['ambiente_id'] ?>')" class="opcao">❌</a>
                        <a href="#" title="Editar ambiente" onclick="loadEnvEditForm('<?= $row['ambiente_id'] ?>')" class="opcao">✏️</a>
                        <a href="#" title="Ver reservas" onclick="loadEnvReserves('<?= $row['ambiente_id'] ?>')" class="opcao">🔍</a>
                    <?php else: ?>
                        <a href="#" title="Ativar ambiente" onclick="inativateEnv('<?= $row['ambiente_id'] ?>')" class="opcao">✔️</a>
                        <a href="#" title="Editar ambiente" onclick="loadEnvEditForm('<?= $row['ambiente_id'] ?>')" class="opcao">✏️</a>
                        <a href="#" title="Ver reservas" onclick="loadEnvReserves('<?= $row['ambiente_id'] ?>')" class="opcao">🔍</a>    
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>