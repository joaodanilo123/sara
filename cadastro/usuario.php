<section class="container">

    <form class="needs-validation" action="../actions/cadastrar_usuario.php" method="post">
        <fieldset class="col-md">
            <label for="nome">Nome completo</label>
            <input type="text" class="form-control" name="nome" required>
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="email" required>
            <label for="senha">Senha</label>
            <input type="password" class="form-control" name="senha" required>
        </fieldset>

        <br>

        <fieldset class="col-md">

            <div class="custom-control custom-radio">
                <input id="professor" name="tipou" type="radio" class="custom-control-input" value="professor" required onclick="changeTokenField()">
                <label class="custom-control-label" for="prof">Professor</label>
            </div>
            <div class="custom-control custom-radio">
                <input id="admin" name="tipou" type="radio" class="custom-control-input" value="admin" required onclick="changeTokenField()">
                <label class="custom-control-label" for="adm">Administrador</label>
            </div>
            <div class="custom-control custom-radio">
                <input id="agente" name="tipou" type="radio" class="custom-control-input" value="agente" required onclick="changeTokenField()">
                <label class="custom-control-label" for="ap">Agente de Portaria</label>
            </div>

        </fieldset>

        <fieldset class="col-md">
            <label for="token">Token</label>
            <input type="text" name="token" id="token" class="form-control" disabled>
        </fieldset>
        
        <br>

        <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
    </form>

</section>