<?php

include '../config/conexao.php';

$id = $_GET['ambiente'];

$dadosAtuais = $connection->query("SELECT * FROM ambiente WHERE ambiente_id='$id'")->fetch_assoc();

$query = $connection->query('SELECT * FROM tipo_ambiente');
$tipos_ambiente = array();
while ($row = $query->fetch_assoc()) {
    array_push($tipos_ambiente, $row);
}

$query = $connection->query('SELECT * FROM predio');
$predios = array();
while ($row = $query->fetch_assoc()) {
    array_push($predios, $row);
}

$connection->close();

?>

<div class="container">
    <div class="col-md-7 order-md-1">
        <form class="needs-validation" action="../actions/cadastrar_ambiente.php" method="post" novalidate>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="" value="<?= $dadosAtuais['ambiente_nome'] ?>" required>
                    <div class="invalid-feedback">
                        Este campo é obrigatório.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="numero">Número</label>
                    <input type="number" class="form-control" name="numero" placeholder="" value="<?= $dadosAtuais['ambiente_numero'] ?>" required>
                </div>
            </div>

            <h4 class="mb-3">Tipo de Ambiente</h4>

            <div class="d-block my-3">
                <?php foreach ($tipos_ambiente as $tipo) : ?>
                    <?php if ($tipo['tipo'] == $dadosAtuais['tipo_ambiente_id']) : ?>
                        <div>
                            <input id="<?= $tipo['tipo'] ?>" name="tipoa" type="radio" value="<?= $tipo['tipo'] ?>" checked required>
                            <label for="<?= $tipo['tipo'] ?>"><?= $tipo["tipo_ambiente_nome"] ?></label>
                        </div>
                    <?php else : ?>
                        <div>
                            <input id="<?= $tipo['tipo'] ?>" name="tipoa" type="radio" value="<?= $tipo['tipo'] ?>" required>
                            <label for="<?= $tipo['tipo'] ?>"><?= $tipo["tipo_ambiente_nome"] ?></label>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>
            </div>

            <select name="predio" id="predio" class="form-control">
                <?php foreach ($predios as $p) : ?>
                    <?php if ($p['predio_id'] == $dadosAtuais['predio_id']) : ?>
                        <option selected value="<?= $p['predio_id'] ?>"><?= $p['predio_nome'] ?></option>
                    <?php else : ?>
                        <option value="<?= $p['predio_id'] ?>"><?= $p['predio_nome'] ?></option>
                    <?php endif; ?>
                <?php endforeach ?>
            </select>



            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Atualizar</button>
        </form>
    </div>
</div>