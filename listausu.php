<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Usuários - Administrador</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link rel="stylesheet" href="setidioma.php">

</head>
<?php
  //a sessão precisa ser iniciada em cada página
  if (!isset($_SESSION)) {session_start();}

  header("Content-type: text/html;charset=utf-8");
  if (isset($_SESSION['login'])) {
    $login_session = $_SESSION['login'];
    $user_session = $_SESSION['user'];
  }
    
  if (isset($login_session)) {
    echo "<body id='page-top'>";

    echo "<nav class='navbar navbar-expand navbar-dark bg-dark static-top'>";

      echo "<a class='navbar-brand mr-1' href='indexadm.php'>🔓 ". $user_session ."</a>";

      echo "<button class='btn btn-link btn-sm text-white order-1 order-sm-0' id='sidebarToggle' href='indexadm.php'>";
        echo "<i class='fas fa-bars'></i>";
      echo "</button>";

        echo "<div class='input-group'></div>";

      /* Navbar */
      echo "<ul class='navbar-nav ml-auto ml-md-0'>";
        echo "<li class='nav-item dropdown no-arrow'>";
          echo "<a href='logout.php'>";
            echo "<button type='button' class='btn btn-outline-light'>Logout</button>";
          echo "</a>";
          echo "</div>";
        echo "</li>";
      echo "</ul>";

    echo "</nav>";

    echo "<div id='wrapper'>";

      /* Sidebar */
      echo "<ul class='sidebar navbar-nav'>";
        echo "<li class='nav-item dropdown'>";
          echo "<a class='nav-link dropdown-toggle' href='#' id='pagesDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
            echo "<i class='fas fa-fw'>🚪</i>";
            echo "<span>Ambientes</span>";
          echo "</a>";
          echo "<div class='dropdown-menu' aria-labelledby='pagesDropdown'>";
            echo "<h6 class='dropdown-header'>Opções:</h6>";
            echo "<a class='dropdown-item' href='indexadm.php'>Listar</a>";
            echo "<a class='dropdown-item' href='cadastroambi.php'>Cadastrar</a>";
          echo "</div>";
        echo "</li>";

        echo "<li class='nav-item dropdown'>";
          echo "<a class='nav-link dropdown-toggle' href='#' id='pagesDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
            echo "<i class='fas fa-fw'>👥</i>";
            echo "<span> Usuários</span>";
          echo "</a>";
          echo "<div class='dropdown-menu' aria-labelledby='pagesDropdown'>";
            echo "<h6 class='dropdown-header'>Opções:</h6>";
            echo "<a class='dropdown-item' href='listausu.php'>Listar</a>";
            echo "<a class='dropdown-item' href='cadastrousu.php'>Cadastrar</a>";
          echo "</div>";
        echo "</li>";
      echo "</ul>";

      echo "<div id='content-wrapper'>";

        echo "<div class='container-fluid'>";

          /* DataTables Example */
            /*Conexão*/
            //$dbc = mysqli_connect('localhost', 'root', 'usbw', 'tcc') or die ('Erro ao conectar ao servidor MySQL');
            $dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die ('Erro ao conectar ao Banco de Dados');
            mysqli_set_charset($dbc,"utf8");
            /*instrução*/
            $query = "SELECT * FROM usuarios";
            $query2 = "SELECT * FROM tipo_usuario";
            /*execução da instrução*//*$dbc = onde -- $query = o que*/
            $result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');
            $resultado = mysqli_query($dbc, $query2) or die ('Erro ao executar o comando SQL 2');
   
            //$resultado = mysqli_fetch_all($result2, MYSQLI_ASSOC);
            mysqli_close($dbc);


            echo '<div class="card mb-3">';
            echo '<div class="card-header">';
              echo '<i class="fas">👥</i>';
                  echo ' Usuários</div>';
                    echo '<div class="card-body">';
                      echo '<div class="table-responsive">';
                        echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                          echo '<thead>';
                            echo '<tr>';
                              echo '<th>ID</th>';
                              echo '<th>Tipo</th>';
                              echo '<th>Nome</th>';
                              echo '<th>Sobrenome</th>';
                              echo '<th>E-mail</th>';
                              //echo '<th>Senha</th>';
                              echo '<th>User</th>';
                              echo '<th>Opções</th>';
                            echo '</tr>';
                          echo '</thead>';
                          echo '<tfoot>';
                          //$row2 = mysqli_fetch_assoc($result2);
                          //echo count($row2);
                          while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['inativo'] == 0) {
                                  // Display the score data
                                  $idusua = $row['id_usua']; 
                                  echo '<tr>';
                                  echo '<th>' . $row['id_usua'] . '</th>';
                                  //Identifica Tipo de Usuário
                                  if(!!$resultado){
                                    foreach($resultado as $item){
                                      if ($item['id_tipo_usua'] == $row['id_tipo_usua']) {
                                        echo '<th>' .$item['descricao'].'</th>' ;
                                        break;
                                      }
                                    }
                                  }
                                  echo '<th>' . $row['nome'] . '</th>';
                                  echo '<th>' . $row['sobrenome'] . '</th>';
                                  echo '<th>' . $row['email'] . '</th>';
                                  //echo '<th>' . $row['senha'] . '</th>';
                                  echo '<th>' . $row['user'] . '</th>';
                                  if ($row['inativo'] == 0) {
                                    echo '<th><a href="alterausu.php?id='. $row['id_usua'] .'">✏️</a> <a style="padding-left:30px" href="removeusu.php?id='. $row['id_usua'] .'" style="color: red;">🗑️</a> <a style="padding-left:30px" data-toggle="tooltip" data-placement="top" title="Inativar" onclick="excluir('.$row['id_usua'].')" style="color: red;">❌</a></th></tr>';
                                  }elseif ($row['inativo'] == 1) {
                                    echo '<th><a href="alterausu.php?id='. $row['id_usua'] .'">✏️</a> <a style="padding-left:30px" href="removeusu.php?id='. $row['id_usua'] .'" style="color: red;">🗑️</a> <a style="padding-left:30px" data-toggle="tooltip" data-placement="top" title="Ativar" href="inativausua.php?id='. $row['id_usua'] .'" style="color: red;">✔️</a></th></tr>';
                                  }
                                }elseif ($row['inativo'] == 1) {
                                  // Display the score data
                                  echo '<tr>';
                                  echo '<th style="color: red;" id="idusua" value="'.$row['id_usua'].'">' . $row['id_usua'] . '</th>';
                                  //Identifica Tipo de Usuário
                                  if(!!$resultado){
                                    foreach($resultado as $item){
                                      if ($item['id_tipo_usua'] == $row['id_tipo_usua']) {
                                        echo '<th style="color: red;">' .$item['descricao'].'</th>' ;
                                        break;
                                      }
                                    }
                                  }
                                  echo '<th style="color: red;">' . $row['nome'] . '</th>';
                                  echo '<th style="color: red;">' . $row['sobrenome'] . '</th>';
                                  echo '<th style="color: red;">' . $row['email'] . '</th>';
                                  //echo '<th style="color: red;">' . $row['senha'] . '</th>';
                                  echo '<th style="color: red;">' . $row['user'] . '</th>';
                                  if ($row['inativo'] == 0) {
                                    echo '<th><a href="alterausu.php?id='. $row['id_usua'] .'">✏️</a> <a style="padding-left:30px" href="removeusu.php?id='. $row['id_usua'] .'" style="color: red;">🗑️</a> <a style="padding-left:30px" data-toggle="tooltip" data-placement="top" title="Inativar" href="inativausua.php?id='. $row['id_usua'] .'" style="color: red;">❌</a></th></tr>';
                                  }elseif ($row['inativo'] == 1) {
                                    echo '<th><a href="alterausu.php?id='. $row['id_usua'] .'">✏️</a> <a style="padding-left:30px" href="removeusu.php?id='. $row['id_usua'] .'" style="color: red;">🗑️</a> <a style="padding-left:30px" data-toggle="tooltip" data-placement="top" title="Ativar" href="inativausua.php?id='. $row['id_usua'] .'" style="color: red;">✔️</a></th></tr>';
                                  }
                                }
                          }
                          echo '</tfoot>';
                        echo '</table>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
                //<!-- /.container-fluid -->
              echo '</div>';
              //<!-- /.content-wrapper -->
            echo '</div>';
            //<!-- /#wrapper -->
            echo '</table>';
            //echo '<a href="menu_principal.php"><input type="button" value="Voltar" class="bv"></a>';


    /* Scroll to Top Button */
    echo "<a class='scroll-to-top rounded' href='#page-top'>";
      echo "<i class='fas fa-angle-up'></i>";
    echo "</a>";

    /* Bootstrap core JavaScript */
    echo "<script src='vendor/jquery/jquery.min.js'></script>";
    echo "<script src='vendor/bootstrap/js/bootstrap.bundle.min.js'></script>";

    /* Core plugin JavaScript */
    echo "<script src='vendor/jquery-easing/jquery.easing.min.js'></script>";

    /* Page level plugin JavaScript */
    echo "<script src='vendor/chart.js/Chart.min.js'></script>";
    echo "<script src='vendor/datatables/jquery.dataTables.js'></script>";
    echo "<script src='vendor/datatables/dataTables.bootstrap4.js'></script>";

    /* Custom scripts for all pages */
    echo "<script src='js/sb-admin.min.js'></script>";

    /* Demo scripts for this page */
    /*<script src="js/demo/datatables-demo.js"></script>*/
    echo "<script src='js/demo/chart-area-demo.js'></script>";

  }
?>
  <script type="text/javascript">
    function excluir(idu){
      var r=confirm("Deseja excluir as reservas do usuário a ser inativado?");
      if (r==true) {window.location = "inativausuaexc.php?id="+idu;}
      else {window.location = "inativausua.php?id="+idu;}
    }
  </script>
</body>

</html>
