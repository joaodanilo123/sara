<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="bootstrap/compiler/bootstrap.css">

    <link rel="icon" href="../../../../favicon.ico">

    <title>Alteração de Ambientes</title>
    <link rel="shortcut icon" href="no.ico">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">
    <?php
      //captura o id repassado pela URL
      $id = $_GET['id'];
      //Conexão ao banco de dados
      //$dbc = mysqli_connect('localhost', 'root', 'usbw', 'tcc') or die ('Erro ao conectar ao servidor MySQL');
      $dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die ('Erro ao conectar ao Banco de Dados'); 
      mysqli_set_charset($dbc,"utf8");
      //instrução a ser executada no banco de dados
      $query = "SELECT id_ambi, id_tipo_ambi, numero, nome FROM ambiente WHERE id_ambi='$id'";
      //execução da instrução no banco de dados
      $result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');
      $row = mysqli_fetch_array($result);
      //encerra a conexao com o banco
      mysqli_close($dbc);
    ?>
    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="SARA.png" style="border-radius: 20px;" alt="" width="72" height="72">
        <h2>Aletre um Ambiente</h2>
      </div>
        <center>
        <div class="col-md-8 order-md-1">
          <form class="needs-validation" action="alterarambi.php" method="post" novalidate>
            <div class="row">
              <input type="hidden" name="id" value="<?php echo $row['id_ambi']; ?>">
              <div class="col-md-6 mb-3">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" value="<?php echo $row['nome']; ?>" required>
                <div class="invalid-feedback">
                  Este campo é obrigatório.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="numero">Número</label>
                <input type="number" class="form-control" name="numero" value="<?php echo $row['numero']; ?>" required>
                <div class="invalid-feedback">
                  Informação inválida.
                </div>
              </div>
            </div>

            <h4 class="mb-3">Tipo de Ambiente</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="audi" name="tipoa" type="radio" class="custom-control-input" value="1" required <?php echo ($row['id_tipo_ambi'] == '1')?'checked':'';?>>
                <label class="custom-control-label" for="audi">Auditório</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="lab" name="tipoa" type="radio" class="custom-control-input" value="2" required <?php echo ($row['id_tipo_ambi'] == '5')?'checked':'';?>>
                <label class="custom-control-label" for="lab">Laboratório</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="sr" name="tipoa" type="radio" class="custom-control-input" value="3" required <?php echo ($row['id_tipo_ambi'] == '6')?'checked':'';?>>
                <label class="custom-control-label" for="sr">Sala de Reuniões</label>
              </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Alterar</button>
            <a href="indexadm.php" class="btn btn-primary btn-lg btn-block" style="background-color: red; border-color: red;">Voltar</a>
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
