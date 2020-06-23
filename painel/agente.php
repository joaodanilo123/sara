<?php

session_start();

if (!isset($_SESSION['id'])) {
  header('Location: ../login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Menu Principal - Agente de Portaria</title>

  <!-- Custom fonts for this template-->
  <link href="../dependencias/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../dependencias/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../dependencias/css/sb-admin.css" rel="stylesheet">

  <style>
    figure {
      text-align: center;
      display: flex;
      flex-direction: column;
      align-content: center;
      flex-wrap: wrap;
    }

    figure img {
      max-height: 300px;
      max-width: 300px;
    }
  </style>

</head>

<body id="page-top">
  <nav class='navbar navbar-expand navbar-dark bg-dark static-top'>
    <a class='navbar-brand mr-1' href='#'>📠<?= $_SESSION['nome'] ?></a>
    <button class='btn btn-link btn-sm text-white order-1 order-sm-0' id='sidebarToggle' href='#'>
      <i class='fas fa-bars'></i>
    </button>

    <ul class='navbar-nav ml-auto ml-md-0'>
      <li class='nav-item dropdown no-arrow'>
        <a href='logout.php'><button type='button' class='btn btn-outline-light'>Logout</button></a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">
    <ul class=' sidebar navbar-nav'>
      <li class='nav-item'>
        <a class='nav-link' href='indexap.php'>
          <i class='fas fa-fw'>📁</i>
          <span>Reservar Ambientes</span></a>
      </li>

      <li class='nav-item'>
        <a class='nav-link' href='mrap.php'>
          <i class='fas fa-fw'>🗂️</i>
          <span>Minhas Reservas</span></a>
      </li>

      <li class='nav-item'>
        <a class='nav-link' href="#" onclick="loadUserData()">
          <i class='fas fa-fw'>📋</i>
          <span>Meus Dados</span></a>
      </li>
    </ul>

    <div id='content-wrapper'>

      <div class='container-fluid'>
        <div class="card mb-3">
          <div class="card-header" id="content-name">
            <figure>
              <img src="../assets/SARA.png" alt="logotipo sara">
              <figcaption><b>Selecione uma opção ao lado</b></figcaption>
            </figure>
          </div>
          <div class="card-body" id="indextable">
          </div>
        </div>
      </div>

      <a class='scroll-to-top rounded' href='#page-top'>
        <i class='fas fa-angle-up'></i>
      </a>
    </div>
  </div>

  <script src='../dependencias/vendor/jquery/jquery.min.js'></script>
  <script src='../dependencias/vendor/bootstrap/js/bootstrap.bundle.min.js'></script>


  <script src='../dependencias/vendor/jquery-easing/jquery.easing.min.js'></script>


  <script src='../dependencias/vendor/chart.js/Chart.min.js'></script>
  <script src='../dependencias/vendor/datatables/jquery.dataTables.js'></script>
  <script src='../dependencias/vendor/datatables/dataTables.bootstrap4.js'></script>


  <script src='../dependencias/js/sb-admin.min.js'></script>
  <script src='../dependencias/js/demo/chart-area-demo.js'></script>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <script>
    async function loadUserData() {
      const id = '<?= $_SESSION['id'] ?>';
      const params = new URLSearchParams();
      params.append('id', id);

      const instance = axios.create({
        baseURL: 'http://localhost/sara/actions',
      });

      const response = await instance.post('/dados_usuario.php', params)

      if (response.status === 200) {
        document.getElementById('indextable').innerHTML = response.data;
        document.getElementById('content-name').innerText = 'Dados do usuário';
        console.log(response)
      }

    }
  </script>
</body>

</html>