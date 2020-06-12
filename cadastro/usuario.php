<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="bootstrap/compiler/bootstrap.css">

  <link rel="icon" href="../assets/SARA.ico">

  <title>Cadastro de Usuários</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/checkout/">

  <!-- Bootstrap core CSS -->
  <link href="../dependencias/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../assets/form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">
  <section class="container">
    <header class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="../assets/SARA.png" alt="logotipo SARA" width="72" height="72">
      <h1>Cadastre um Usuário</h1>
    </header>
    <div class="col-md-8 order-md-1">
      <form class="needs-validation" action="../actions/addusu.php" method="post" novalidate>
        <div class="col-md-6 mb-3">
          <label for="nome">Nome completo</label>
          <input type="text" class="form-control" name="nome" placeholder="" required>
          <label for="email">E-mail</label>
          <input type="email" class="form-control" name="email" placeholder="você@exemplo.com" required>
          <class="mb-3">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" name="senha" placeholder="" required>
        </div>
        <h4 class="mb-3">Tipo de Usuário</h4>

        <div class="d-block my-3">
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
        </div>
      </form>
    </div>

    <hr class="mb-4">
    <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
    <a href="listausu.php" class="btn btn-primary btn-lg btn-block" style="background-color: red; border-color: red;">Voltar</a>

  </section>

</body>

</html>