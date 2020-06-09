<?php 

include '../config/conexao.php';

$query = $connection->query('SELECT * FROM tipo_ambiente');
$tipos_ambiente = array();
while ($row = $query->fetch_assoc()) {
    array_push($tipos_ambiente, $row);
}
$connection->close();
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../dependencias/bootstrap/compiler/bootstrap.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/checkout/">
    <link href="../dependencias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/form-validation.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../assets/SARA.ico">
    <title>Cadastro de Ambientes</title>
</head>

<body class="bg-light">
    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="../assets/SARA.png" style="border-radius: 20px;" alt="" width="72" height="72">
            <h2>Cadastre um Ambiente</h2>
        </div>
        <div class="col-md-7 order-md-1">
            <form class="needs-validation" action="../actions/addambi.php" method="post" novalidate>
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
                <?php foreach($tipos_ambiente as $tipo):?>
                    <div class="custom-control custom-radio">
                        <input id="audi" name="tipoa" type="radio" class="custom-control-input" value="<?=$tipo["tipo_ambiente_id"]?>" required>
                        <label class="custom-control-label" for="audi"><?=$tipo["tipo_ambiente_nome"]?></label>
                    </div>
                <?php endforeach; ?>
                </div>
                

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
                <a href="../painel/admin" class="btn btn-primary btn-lg btn-block" style="background-color: red; border-color: red;">Voltar</a>
            </form>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="../dependencias/popper.js/dist/popper.min.js"></script>
    <script src="../dependencias/bootstrap/js/bootstrap.min.js"></script>
    <!--<script src="../../assets/js/vendor/holder.min.js"></script>-->
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

    <script src="../dependencias/jquery/dist/jquery.min.js"></script>
</body>

</html>