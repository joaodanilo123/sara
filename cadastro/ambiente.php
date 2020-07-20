<?php

include '../config/conexao.php';

$query = $connection->query('SELECT * FROM tipo_ambiente');
$tipos_ambiente = array();
while ($row = $query->fetch_assoc()) {
    array_push($tipos_ambiente, $row);
}
$connection->close();
?>

<div class="container">
    <div class="col-md-7 order-md-1">
        <form class="needs-validation" action="../actions/cadastrar_ambiente.php" method="post" novalidate>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="" required>
                    <div class="invalid-feedback">
                        Este campo é obrigatório.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="numero">Número</label>
                    <input type="number" class="form-control" name="numero" placeholder="" required>
                </div>
            </div>

            <h4 class="mb-3">Tipo de Ambiente</h4>

            <div class="d-block my-3">
                <?php foreach ($tipos_ambiente as $tipo) : ?>
                    <div>
                        <input id="<?= $tipo['tipo'] ?>" name="tipoa" type="radio" value="<?= $tipo['tipo'] ?>" required>
                        <label for="<?= $tipo['tipo'] ?>"><?= $tipo["tipo_ambiente_nome"] ?></label>
                    </div>
                <?php endforeach; ?>
            </div>


            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
        </form>
    </div>
</div>

