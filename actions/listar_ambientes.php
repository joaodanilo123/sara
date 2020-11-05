<?php

include '../config/conexao.php';

if(isset($_GET['predio'])){
    $sql = "SELECT * FROM tipo_ambiente 
            INNER JOIN ambiente ON tipo_ambiente.tipo = ambiente.tipo_ambiente_id
            INNER JOIN predio ON ambiente.predio_id = predio.predio_id AND ambiente.predio_id = :predio";
    
} else {
    $sql = "SELECT * FROM tipo_ambiente 
    INNER JOIN ambiente ON tipo_ambiente.tipo = ambiente.tipo_ambiente_id
    INNER JOIN predio ON ambiente.predio_id = predio.predio_id";
}

$sql .= ' ORDER BY ambiente_ativo DESC';
$query = $connection->prepare($sql);
$query->bindParam(':predio', $_GET['predio']);
$query->execute();
$data = $query->fetchAll();

?>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <tr>
            <td><b>ID</b></td>
            <td><b>Nome</b></td>
            <td><b>Número</b></td>
            <td><b>Prédio</b></td>
            <td><b>Tipo</b></td>
            <td><b>Ativo</b></td>
            <td style="width: 10%;"><b>Opções</b></td>
        </tr>
        <?php foreach($data as $row): ?>
            <tr>
                <td><?= $row['ambiente_id'] ?></td>
                <td><?= $row['ambiente_nome'] ?></td>
                <td style="text-align:center"><?= $row['ambiente_numero'] ?></td>
                <td><?= $row['predio_nome'] ?></td>
                <td><?= $row['tipo_ambiente_nome'] ?></td>
                <td><?= $row['ambiente_ativo'] ?></td>
                <td style="text-align:center">
                    <a href="#" title="Editar ambiente" onclick="loadEnvEditForm('<?= $row['ambiente_id'] ?>')" class="opcao">✏️</a>
                    <a href="#" title="Ver reservas" onclick="loadSearch('<?= $row['ambiente_id'] ?>')" class="opcao">🔍</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php 
$connection = null;
?>