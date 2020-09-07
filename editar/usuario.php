<?php

include '../config/conexao.php';

$id = $_GET['usuario'];
$dadosAtuais = $connection->query("SELECT * FROM usuario WHERE usuario_id='$id'")->fetch_assoc();

$query = $connection->query('SELECT * FROM hierarquia');
$hierarquias = array();
while ($row = $query->fetch_assoc()) {
    array_push($hierarquias, $row);
}

$connection->close();

?>

<div class="container">
    <div class="col-md-7 order-md-1">
        <form class="needs-validation" action="../actions/editar_usuario.php" method="post" novalidate>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nome">
                        <h4 class="mb-3">Nome</h4>
                    </label>
                    <input type="text" class="form-control" name="nome" placeholder="" value="<?= $dadosAtuais['usuario_nome'] ?>" required>
                    <div class="invalid-feedback">
                        Este campo é obrigatório.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="numero">
                        <h4 class="mb-3">Email</h4>
                    </label>
                    <input type="email" class="form-control" name="email" placeholder="" value="<?= $dadosAtuais['usuario_email'] ?>" required>
                </div>
            </div>

            <h4 class="mb-3">Tipo de usuário</h4>

            <div class="d-block my-3">
                <?php foreach ($hierarquias as $h) :
                    $check = $h['hierarquia_nome'] == $dadosAtuais['hierarquia_nome'];
                ?>
                    <div>
                        <input 
                            id="<?= $h['hierarquia_nome'] ?>" 
                            name="hierarquia" type="radio" 
                            value="<?= $h['hierarquia_nome'] ?>" 
                            checked="<?= $check ? 'true' : 'false' ?>" 
                            onclick="changeTokenField()"
                            required
                        >
                        <label for="<?= $h['hierarquia_nome'] ?>"><?= $h['hierarquia_nome'] ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <fieldset>
                <label for="token">Token</label>
                <input type="text" name="token" id="token" class="form-control" value="<?= $dadosAtuais['usuario_token'] ?>">
            </fieldset>
            <br>
            <fieldset>
                <label for="senha">Senha (deixe em branco para não alterar) </label>
                <input type="password" name="senha" id="senha" class="form-control">
            </fieldset>       

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Atualizar</button>
            <input type="hidden" name="id" value="<?= $dadosAtuais['usuario_id'] ?>">
        </form>
    </div>
</div>