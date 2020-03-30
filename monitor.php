<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/compiler/bootstrap.css">

    <link rel="icon" href="../../../../favicon.ico">
    <title>Reservas</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">
    <script type="text/javascript">
      Redirect();
      function Redirect(){
        setTimeout("location.reload(true);", 60000);
      }
    </script>
  </head>

  <body style="background-color: #111111;">
    <?php
      //$dbc = mysqli_connect('localhost', 'root', 'usbw', 'tcc') or die ('Erro ao conectar ao servidor MySQL');
      $dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die ('Erro ao conectar ao Banco de Dados');
      mysqli_set_charset($dbc,"utf8");
      date_default_timezone_set('America/Sao_Paulo');
      $hora=date('H');

      if ($hora < 12) {
        $query = "SELECT TIME(start), TIME(end), title, id_ambi, id_usua, reservista FROM reservar WHERE date_format(start,'%Y-%m-%d') = curdate() AND HOUR(start) BETWEEN 7 AND 12";
      }elseif ($hora >= 12 && $hora < 18) {
        $query = "SELECT TIME(start), TIME(end), title, id_ambi, id_usua, reservista FROM reservar WHERE date_format(start,'%Y-%m-%d') = curdate() AND HOUR(start) BETWEEN 12 AND 18";
      }elseif ($hora >= 18 && $hora <=23) {
        $query = "SELECT TIME(start), TIME(end), title, id_ambi, id_usua, reservista FROM reservar WHERE date_format(start,'%Y-%m-%d') = curdate() AND HOUR(start) BETWEEN 18 AND 23";
      }

      $query4 = "SELECT TIME(start), TIME(end), title, id_ambi, id_usua, reservista FROM reservar WHERE date_format(start,'%Y-%m-%d') = curdate() AND HOUR(start) BETWEEN 0 AND 0";
      $result4 = mysqli_query($dbc, $query4) or die ('Erro ao executar o comando SQL 4');

      $result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');

      $query2 = "SELECT *  FROM ambiente";
      $resultado2 = mysqli_query($dbc, $query2) or die ('Erro ao executar o comando SQL 2');
      //$resultado2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

      $query3 = "SELECT *  FROM usuarios";
      $resultado3 = mysqli_query($dbc, $query3) or die ('Erro ao executar o comando SQL 3');
      //$resultado3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);

      
    ?>
    <div class="container">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
    </div>
      <center>
      <h1 class="mr-auto mr-lg-0" href="#" style="color: white; font-family: times;">SARA&nbsp;- Sistema de Administração de Reservas de Ambientes</h1>
      </center>
    <div class="container">
      <!--<div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Notifications</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
      </div>--> 
    </nav>

    <main role="main" class="">
      <div class="my-3 p-3 rounded shadow-sm" style="border-color: white;">
        <?php
          if ($hora < 12) {
            echo '<h6 class="border-bottom border-gray pb-2 mb-0" style="color: yellow; font-size: 25px; font-family: times;">Reservas do Turno Matutino</h6>';
          }elseif ($hora >= 12 && $hora < 18) {
            echo '<h6 class="border-bottom border-gray pb-2 mb-0" style="color: yellow; font-size: 25px; font-family: times;">Reservas do Turno Vespertino</h6>';
          }elseif ($hora >= 18 && $hora <=23) {
            echo '<h6 class="border-bottom border-gray pb-2 mb-0" style="color: yellow; font-size: 25px; font-family: times;">Reservas do Turno Noturno</h6>';
          }
  
          echo '<div class="">';
              echo '<div class="">';
                echo '<div class="">';
                  echo '<div class="table-responsive">';
                    echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                    echo '<thead>';
                      echo '<tr>';
                        echo '<th style="color: yellow; font-family: times;">Horário</th>';
                        echo '<th style="color: yellow; font-family: times;">Ambiente</th>';
                        echo '<th style="color: yellow; font-family: times;">Atividade</th>';
                        echo '<th style="color: yellow; font-family: times;">Solicitador</th>';
                      echo '</tr>';
                    echo '</thead>';
                    echo '<tfoot style="color: white;">';
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<th><a style="color: yellow; font-family: times;" disabled>Início: </a>'. $row['TIME(start)'] .' &nbsp;&nbsp;&nbsp; <a style="color: yellow; font-family: times;" disabled>Fim: </a>'. $row['TIME(end)'] .'</th>';
                      if(!!$resultado2){
                        foreach($resultado2 as $item){
                          if ($item['id_ambi'] == $row['id_ambi']) {
                            echo '<th>' .$item['nome'].' - '. $item['numero'] .'</th>';
                            break;
                          }
                        }
                      }
                      echo '<th>'. $row['title'] .'</th>';
                      echo '<th>'. $row['reservista'] .'</th>';
                      echo '</tr>';
                    }
                    echo '</tfoot>';
                    echo '</table>';
                  echo '</div>';
                echo '</div>';
              echo '</div>';
            echo '</div>';

            echo '<h6 class="border-bottom border-gray pb-2 mb-0" style="color: orange; font-size: 25px; font-family: times;">Reservas do Dia Todo</h6>';
            echo '<div class="" style="color: white;">';
              echo '<div class="">';
                echo '<div class="">';
                  echo '<div class="table-responsive">';
                    echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                    echo '<thead>';
                      echo '<tr>';
                        echo '<th style="color: orange; font-family: times;">Horário</th>';
                        echo '<th style="color: orange; font-family: times;">Ambiente</th>';
                        echo '<th style="color: orange; font-family: times;">Atividade</th>';
                        echo '<th style="color: orange; font-family: times;">Solicitador</th>';
                      echo '</tr>';
                    echo '</thead>';
                    echo '<tfoot>';
                    while ($row4 = mysqli_fetch_assoc($result4)) {
                      echo '<tr>';
                      echo '<th><a style="color: orange; font-family: times;" disabled>Início: </a>'. $row4['TIME(start)'] .' &nbsp;&nbsp;&nbsp; <a style="color: orange; font-family: times;" disabled>Fim: </a>'. $row4['TIME(end)'] .'</th>';
                      if(!!$resultado2){
                        foreach($resultado2 as $item){
                          if ($item['id_ambi'] == $row4['id_ambi']) {
                            echo '<th>' .$item['nome'].' - '. $item['numero'] .'</th>';
                            break;
                          }
                        }
                      }
                      echo '<th>'. $row4['title'] .'</th>';
                      echo '<th>'. $row4['reservista'] .'</th>';
                      echo '</tr>';
                    }
                    echo '</tfoot>';
                    echo '</table>';
                  echo '</div>';
                echo '</div>';
              echo '</div>';
            echo '</div>';
        ?>
        <!--<small class="d-block text-right mt-3">
          <a href="#">All updates</a>
        </small>-->
      </div>
    </main>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script src="offcanvas.js"></script>

    <script src="jquery/dist/jquery.js"></script>
    <script src="popper.js/dist/umd/popper.js" ></script>
    <script src="bootstrap/dist/js/bootstrap.js" ></script>
  </body>
</html>
