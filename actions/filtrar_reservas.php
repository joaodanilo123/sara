<?php

require '../config/conexao.php';

function carregar_ambientes()
{
    global $connection;

    $sql = "SELECT ambiente_id, ambiente_nome FROM ambiente";
    return $connection->query($sql);
}
function carregar_professores()
{
    global $connection;

    $sql = "SELECT usuario_id, usuario_nome FROM usuario WHERE hierarquia_nome='professor'";
    return $connection->query($sql);
}
function carregar_agentes()
{
    global $connection;

    $sql = "SELECT usuario_id, usuario_nome FROM usuario WHERE hierarquia_nome='agente'";
    return $connection->query($sql);
}

$ambientes = carregar_ambientes();
$profs = carregar_professores();
$agentes = carregar_agentes();

?>

<div class="container">
    <div>
        <form class="needs-validation" method="get" novalidate>
            <div class="row">
                <select id="ambiente" class="form-control col-3 m-2">
                    <?php while ($amb = $ambientes->fetch_assoc()) : ?>
                        <option value="<?= $amb['ambiente_id'] ?>"><?= $amb['ambiente_nome'] ?></option>
                    <?php endwhile ?>
                </select>
                <select id="reservista" class="form-control col-3 m-2">
                    <?php while ($prof = $profs->fetch_assoc()) : ?>
                        <option value="<?= $prof['usuario_id'] ?>"><?= $prof['usuario_nome'] ?></option>
                    <?php endwhile ?>
                </select>
                <select id="agente" class="form-control col-3  m-2">
                    <?php while ($agente = $agentes->fetch_assoc()) : ?>
                        <option value="<?= $agente['usuario_id'] ?>"><?= $agente['usuario_nome'] ?></option>
                    <?php endwhile ?>
                </select>
                <input type="button" value="Buscar" onclick="loadReserves()" class="btn btn-primary col-1 m-1">
            </div>
        </form>
        <div id="calendar"></div>
    </div>
</div>
