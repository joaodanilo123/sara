<?php

include '../config/conexao.php';

$sql = "SELECT * FROM ambiente ";
$sql .= isset($_GET['predio']) ? "WHERE predio_id='{$_GET['predio']}' " : '';
$sql .= 'ORDER BY ambiente_ativo DESC';
$result = $connection->query($sql);

function carregar_nomes_predios($predio_id){
    global $connection;
    $sql = "SELECT predio_nome FROM predio WHERE predio_id='$predio_id'";
    return $connection->query($sql)->fetch_assoc()['predio_nome'];
}

?>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <tr>
            <td><b>ID</b></td>
            <td><b>Nome</b></td>
            <td><b>Número</b></td>
            <td><b>Prédio</b></td>
            <td><b>Ativo</b></td>
            <td style="width: 10%;"><b>Opções</b></td>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['ambiente_id'] ?></td>
                <td><?= $row['ambiente_nome'] ?></td>
                <td style="text-align:center"><?= $row['ambiente_numero'] ?></td>
                <td><?= carregar_nomes_predios($row['predio_id']) ?></td>
                <td><?= $row['ambiente_ativo'] ?></td>
                <td style="text-align:center">
                    <a href="#" title="Editar ambiente" onclick="loadEnvEditForm('<?= $row['ambiente_id'] ?>')" class="opcao">✏️</a>
                    <a href="#" title="Ver reservas" onclick="loadSearch('<?= $row['ambiente_id'] ?>')" class="opcao">🔍</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php 
$connection->close();
?>