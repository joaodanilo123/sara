<?php
session_start();
require '../utils/verificarSessao.php';

?>

<div class="container">
    <div class="col-md-7 order-md-1">
        <form class="needs-validation" action="../actions/cadastrar_predio.php" method="post" novalidate>
            <div class="row">
                <div class="col-lg mb-3">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="" required>
                    <div class="invalid-feedback">
                        Este campo é obrigatório.
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
        </form>
    </div>
</div>