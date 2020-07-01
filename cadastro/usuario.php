<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="../assets/SARA.ico">
  <link href="../dependencias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <title>Cadastro de Usuários</title>
</head>

<body class="bg-light">
  <section class="container">
    <header class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="../assets/SARA.png" alt="logotipo SARA" width="72" height="72">
      <h1>Cadastre um Usuário</h1>
    </header>
    <div>
      <form class="needs-validation" action="../actions/addusu.php" method="post">
        <fieldset class="col-md">
          <label for="nome">Nome completo</label>
          <input type="text" class="form-control" name="nome" required>
          <label for="email">E-mail</label>
          <input type="email" class="form-control" name="email" required>
          <label for="senha">Senha</label>
          <input type="password" class="form-control" name="senha" required>
        </fieldset>

        <fieldset class="col-md">
          <h4 class="mb-3">Tipo de Usuário</h4>
          <div class="custom-control custom-radio">
            <input id="prof" name="tipou" type="radio" class="custom-control-input" value="professor" required>
            <label class="custom-control-label" for="prof">Professor</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="adm" name="tipou" type="radio" class="custom-control-input" value="admin" required>
            <label class="custom-control-label" for="adm">Administrador</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="ap" name="tipou" type="radio" class="custom-control-input" value="agente" required>
            <label class="custom-control-label" for="ap">Agente de Portaria</label>
          </div>
        </fieldset>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
      </form>
    </div>

    <hr class="mb-4">
    
    <a href="../painel/admin.php" class="btn btn-danger btn-lg btn-block">Voltar</a>

  </section>

</body>

</html>