<?php
  session_start();
  require_once '../utils/verificarSessao.php';
  
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Menu Principal - Professor</title>

  <!-- Custom fonts for this template-->
  <link href="../dependencias/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../dependencias/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../dependencias/css/sb-admin.css" rel="stylesheet">


</head>

<body id="page-top">
  <nav class='navbar navbar-expand navbar-dark bg-dark static-top'>

    <a class='navbar-brand mr-1' href='#'> 💼 <?=$user_session?></a>

    <button class='btn btn-link btn-sm text-white order-1 order-sm-0' id='sidebarToggle' href='#'>
      <i class='fas fa-bars'></i>
    </button>

    <div class='input-group'>
    </div>

    <ul class='navbar-nav ml-auto ml-md-0'>
      <li class='nav-item dropdown no-arrow'>
        <a href='logout.php'><button type='button' class='btn btn-outline-light'>Logout</button></a>
        </div>
      </li>
    </ul>

  </nav>

  <div id='wrapper'>

    <ul class='sidebar navbar-nav'>
      <li class='nav-item'>
        <a class='nav-link' href='indexprof.php'>
          <i class='fas fa-fw'>📁</i>
          <span>Reservar Ambientes</span></a>
      </li>

      <li class='nav-item'>
        <a class='nav-link' href='mrprof.php'>
          <i class='fas fa-fw'>🗂️</i>
          <span>Minhas Reservas</span></a>
      </li>

      <li class='nav-item'>
        <a class='nav-link' href='mdprof.php'>
          <i class='fas fa-fw'>📋</i>
          <span>Meus Dados</span></a>
      </li>
    </ul>

    <div id='content-wrapper'>

      <div class='container-fluid'>
        <?
        /* DataTables Example */
        /*Conexão*/
        //$dbc = mysqli_connect('localhost', 'root', 'usbw', 'tcc') or die ('Erro ao conectar ao servidor MySQL');
        $dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die('Erro ao conectar ao Banco de Dados');
        mysqli_set_charset($dbc, "utf8");
        /*instrução*/
        $query = "SELECT * FROM ambiente";
        $query2 = "SELECT * FROM tipo_ambiente";
        /*execução da instrução*//*$dbc = onde -- $query = o que*/
        $result = mysqli_query($dbc, $query) or die('Erro ao executar o comando SQL');
        $resultado = mysqli_query($dbc, $query2) or die('Erro ao executar o comando SQL 2');

        //$resultado = mysqli_fetch_all($result2, MYSQLI_ASSOC);
        mysqli_close($dbc);
        ?>
        <div class='card mb-3'>
          <div class='card-header'>
            <i class='fas'>📁</i>
            Escolha um Ambiente</div>
          <div class='card-body'>
            <div class='table-responsive'>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Tipo</th>
                    <th>Nome</th>
                    <th>Número</th>
                    <th>Opções</th>
                  </tr>
                </thead>
                <tfoot>
                  <?php
                  /* while ($row = mysqli_fetch_assoc($result)) { 
                              // Display the score data
                              if ($row['inativo'] == 0) {
                                ?>
                                 <tr><?php
                                //Identifica Tipo de Usuário
                                if(!!$resultado){
                                  foreach($resultado as $item){
                                    if ($item['id_tipo_ambi'] == $row['id_tipo_ambi']) { ?>
                                       <th>' .$item['descricao'].'</th>' ;
                                      break;
                                    }
                                  }
                                }?>
                                 <th>' . $row['nome'] . '</th>
                                 <th>' . $row['numero'] . '</th>
                                 <th><a href="index.php?id='. $row['id_ambi'] .'">📆</a></th></tr>
                              }elseif ($row['inativo'] == 1) {
                                 <tr>
                                //Identifica Tipo de Usuário
                                if(!!$resultado){
                                  foreach($resultado as $item){
                                    if ($item['id_tipo_ambi'] == $row['id_tipo_ambi']) {
                                       <th style="color: red;">' .$item['descricao'].'</th>' ;
                                      break;
                                    }
                                  }
                                }
                                 <th style="color: red;">' . $row['nome'] . '</th>
                                 <th style="color: red;">' . $row['numero'] . '</th>
                                 <th style="color: red;"><label>INATIVADO</label></th></tr>
                              }  
                            }
                          */ ?>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </table>
  <a class='scroll-to-top rounded' href='#page-top'>
    <i class='fas fa-angle-up'></i>
  </a>

  <script src='../dependencias/vendor/jquery/jquery.min.js'></script>
  <script src='../dependencias/vendor/bootstrap/js/bootstrap.bundle.min.js'></script>


  <script src='../dependencias/vendor/jquery-easing/jquery.easing.min.js'></script>

  <script src='../dependencias/vendor/chart.js/Chart.min.js'></script>
  <script src='../dependencias/vendor/datatables/jquery.dataTables.js'></script>
  <script src='../dependencias/vendor/datatables/dataTables.bootstrap4.js'></script>

  <script src='../dependencias/js/sb-admin.min.js'></script>

  <script src="../dependencias/js/demo/datatables-demo.js"></script>
  <script src='../dependencias/js/demo/chart-area-demo.js'></script>

</body>

</html>