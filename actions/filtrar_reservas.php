<?php

require '../config/conexao.php';

$ambiente_selecionado = isset($_GET['ambiente']) ? $_GET['ambiente'] : 'todos';
$professor_selecionado = isset($_GET['prof']) ? $_GET['prof'] : 'todos';
$agente_selecionado = isset($_GET['agente']) ? $_GET['agente'] : 'todos';

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

                <fieldset class="col-3  m-2">
                    <label for="ambiente">Ambiente</label>
                    <select id="ambiente" class="form-control">
                        <?php if ($ambiente_selecionado === 'todos'): ?>
                            <option selected value="todos">Todos</option>
                        <?php endif?>
                        <?php while ($amb = $ambientes->fetch_assoc()): ?>
                            <?php if ($amb['ambiente_id'] == $ambiente_selecionado): ?>
                                <option selected value="<?=$amb['ambiente_id']?>"><?=$amb['ambiente_nome']?></option>
                            <?php else: ?>
                                <option value="<?=$amb['ambiente_id']?>"><?=$amb['ambiente_nome']?></option>
                            <?php endif?>
                        <?php endwhile?>
                    </select>
                </fieldset>


                <fieldset class="col-3  m-2">
                    <label for="reservista">Professor</label>
                    <select id="reservista" class="form-control">
                        <?php if ($professor_selecionado === 'todos'): ?>
                            <option selected value="todos">Todos</option>
                        <?php endif?>
                        <?php while ($prof = $profs->fetch_assoc()): ?>
                            <?php if ($prof['usuario_id'] == $professor_selecionado): ?>
                                <option selected value="<?=$prof['usuario_id']?>"><?=$prof['usuario_nome']?></option>
                            <?php else: ?>
                                <option value="<?=$prof['usuario_id']?>"><?=$prof['usuario_nome']?></option>
                            <?php endif?>
                        <?php endwhile?>
                    </select>
                </fieldset>
                
                <fieldset class="col-3  m-2">
                    <label for="agente">Agente</label>
                    <select id="agente" class="form-control">
                        <?php if ($agente_selecionado === 'todos'): ?>
                            <option selected value="todos">Todos</option>
                        <?php endif?>
                        <?php while ($agente = $agentes->fetch_assoc()): ?>
                            <?php if ($agente['usuario_id'] == $agente_selecionado): ?>
                                <option selected value="<?=$agente['usuario_id']?>"><?=$agente['usuario_nome']?></option>
                            <?php else: ?>
                                <option value="<?=$agente['usuario_id']?>"><?=$agente['usuario_nome']?></option>
                            <?php endif?>
                        <?php endwhile?>
                    </select>
                </fieldset>
                
                <input type="button" value="Buscar" onclick="loadReserves()" class="btn btn-primary col-1 m-1">
            </div>
        </form>
        <div id="calendar"></div>
    </div>
</div>
