<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="bootstrap/compiler/bootstrap.css">

    <link rel="icon" href="../../../../favicon.ico">

    <title>Cadastro de Usuários</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">
    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="SARA.png" alt="" width="72" height="72">
        <h2>Cadastre um Usuário</h2>
      </div>
        <center>
        <div class="col-md-8 order-md-1">
          <form class="needs-validation" action="addusu.php" method="post" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" placeholder="" required>
                <div class="invalid-feedback">
                  Este campo é obrigatório.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="sobrenome">Sobrenome</label>
                <input type="text" class="form-control" name="sobrenome" placeholder="" required>
                <div class="invalid-feedback">
                  Este campo é obrigatório.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">E-mail</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="email" class="form-control" name="email" placeholder="você@exemplo.com" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Este e-mail é inválido.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="user">Nome de Usuário</label>
              <input type="text" class="form-control" name="user" placeholder="" required>
              <div class="invalid-feedback">
                Este campo é obrigatório.
              </div>
            </div>

            <div class="mb-3">
              <label for="senha">Senha</label>
              <input type="password" class="form-control" name="senha" placeholder="" required>
              <div class="invalid-feedback">
                Este campo é obrigatório.
              </div>
            </div>

            <h4 class="mb-3">Tipo de Usuário</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="prof" name="tipou" type="radio" class="custom-control-input" value="1" required>
                <label class="custom-control-label" for="prof">Professor</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="adm" name="tipou" type="radio" class="custom-control-input" value="2" required>
                <label class="custom-control-label" for="adm">Administrador</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="ap" name="tipou" type="radio" class="custom-control-input" value="3" required>
                <label class="custom-control-label" for="ap">Agente de Portaria</label>
              </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
            <a href="listausu.php" class="btn btn-primary btn-lg btn-block" style="background-color: red; border-color: red;">Voltar</a>
          </form>
          </center>
        </div>
      </div><br>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>

    <script src="jquery/dist/jquery.js"></script>
    <script src="popper.js/dist/umd/popper.js" ></script>
    <script src="bootstrap/dist/js/bootstrap.js" ></script>
  </body>
</html>
