<?php
session_start();
session_destroy();
?>

<!doctype html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="icon" href="./assets/SARA.ico">

<title>Login</title>

<link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/sign-in/">

<!-- Bootstrap core CSS -->
<link href="./dependencias/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="./assets/signin.css" rel="stylesheet">
</head>

<body class="text-center">
  <form class="form-signin" method="post" action="./actions/logar.php">
    <img class="mb-4" src="./assets/SARA.png" alt="sara" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Faça seu login</h1>
    <label for="email" class="sr-only">E-mail</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
    <label for="senha" class="sr-only">Senha</label>
    <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit" id="entrar" name="submit_button">Acessar</button>
  </form>

  <script src="./dependencias/jquery/dist/jquery.js"></script>
  <script src="./dependencias/popper.js/dist/umd/popper.js"></script>
  <script src="./dependencias/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>