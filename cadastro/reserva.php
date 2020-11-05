<?php

session_start();
require '../config/conexao.php';

try {
    
    $sql = "SELECT usuario_nome, usuario_id FROM usuario WHERE hierarquia_nome='professor'";
    $pd = $connection->query($sql)->fetchAll();

    $sql = "SELECT ambiente_nome, ambiente_id FROM ambiente WHERE ambiente_ativo='sim'";
    $ad = $connection->query($sql)->fetchAll();

} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}

?>
<form action="../actions/reservar.php" method="post">
    <select name="ambiente" id="ambiente" onchange="loadReserveFormCalendar()">
        <option disabled selected>Selecione um ambiente</option>
        <?php foreach ($ad as $data) : ?>
            <option value="<?= $data['ambiente_id'] ?>"><?= $data['ambiente_nome'] ?></option>
        <?php endforeach ?>
    </select>
    <div class="modal fade" id="reserve-modal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="label">Nova reserva</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <label for="professor">Reservista:</label>
                        <select name="professor" id="professor" class="form-control">
                            <option disabled selected>Selecione um professor</option>
                            <?php foreach ($pd as $data) : ?>
                                <option value="<?= $data['usuario_id'] ?>"><?= $data['usuario_nome'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </fieldset>
                    <section class="form-row">
                        <fieldset class="form-group col-m6">
                            <label for="inicio">Início:</label>
                            <input type="datetime-local" name="inicio" id="inicio">
                        </fieldset>
                        <fieldset class="form-group col-m6">
                            <label for="fim">Fim:</label>
                            <input type="datetime-local" name="fim" id="fim">
                        </fieldset>
                    </section>
                    <fieldset class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control"></textarea>
                    </fieldset>
                    <fieldset class="form-row">
                        <label for="color">Cor de exibição no calendário</label>
                        <select name="color" class="form-control" id="color">
                            <option disabled selected>Selecione</option>
                            <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                            <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                            <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                            <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                            <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                            <option style="color:#436EEE;" value="#436EEE">Azul Royal</option>
                            <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                            <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                            <option style="color:#228B22;" value="#228B22">Verde</option>
                            <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                        </select>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" value="Reservar" class="col btn btn-primary">
                </div>
            </div>
        </div>
    </div>
    <div id="calendar"></div>
</form>