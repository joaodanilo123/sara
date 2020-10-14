<?php

session_start();
require_once '../utils/verificarSessao.php';

$messages = isset($_GET['messages']) ? $_GET['messages'] : [];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../dependencias/fullcalendar-4.1.0/packages/core/main.min.css">
    <link rel="stylesheet" href="../dependencias/fullcalendar-4.1.0/packages/daygrid/main.min.css">
    <link rel="stylesheet" href="../dependencias/fullcalendar-4.1.0/packages/timegrid/main.min.css">
    <script src="../dependencias/fullcalendar-4.1.0/packages/core/main.min.js"></script>
    <script src="../dependencias/fullcalendar-4.1.0/packages/interaction/main.min.js"></script>
    <script src="../dependencias/fullcalendar-4.1.0/packages/daygrid/main.min.js"></script>
    <script src="../dependencias/fullcalendar-4.1.0/packages/timegrid/main.min.js"></script>
    <script src="../dependencias/fullcalendar-4.1.0/packages/core/locales/pt-br.js"></script>
    <link href="../dependencias/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../dependencias/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../dependencias/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/panel_custom.css">
    <title>Menu Principal - Agente de Portaria</title>
</head>

<body id="page-top">
    <nav class='navbar navbar-expand navbar-dark bg-dark static-top'>
        <a class='navbar-brand mr-1' href='#'>📠<?= $_SESSION['nome'] ?></a>
        <button class='btn btn-link btn-sm text-white order-1 order-sm-0' id='sidebarToggle' href='#'>
            <i class='fas fa-bars'></i>
        </button>

        <ul class='navbar-nav ml-auto ml-md-0'>
            <li class='nav-item dropdown no-arrow'>
                <a href='../actions/logout.php'><button type='button' class='btn btn-outline-light'>Logout</button></a>
                </div>
            </li>
        </ul>

    </nav>

    <div id="wrapper">
        <ul class=' sidebar navbar-nav'>
            <li class='nav-item'>
                <a class='nav-link' href="#" onclick="loadReserveForm()">
                    <i class='fas fa-fw'>📁</i>
                    <span>Nova reserva</span>
                </a>
            </li>

            <li class='nav-item'>
                <a class='nav-link' href="#" onclick="loadUserData()">
                    <i class='fas fa-fw'>📋</i>
                    <span>Meus Dados</span>
                </a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' onclick="loadSearch()">
                    <i class='fas fa-fw'>🔎</i>
                    <span>Buscar reservas</span>
                </a>
            </li>
        </ul>

        <div id='content-wrapper'>

            <div class='container-fluid'>
                <div class="card mb-3" id="content">
                    <div class="card-header" id="content-name">
                        <figure>
                            <img src="../assets/SARA.png" alt="logotipo sara">
                            <figcaption>
                                <b>Selecione uma opção ao lado</b>
                                <?php foreach($messages as $m){
                                    echo $m.'<br>';
                                }?>
                            </figcaption>
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
    <input type="hidden" id="user_id" value="<?=$_SESSION['id']?>">
    <script src='../dependencias/vendor/jquery/jquery.min.js'></script>
    <script src='../dependencias/vendor/bootstrap/js/bootstrap.bundle.min.js'></script>


    <script src='../dependencias/vendor/jquery-easing/jquery.easing.min.js'></script>


    <script src='../dependencias/vendor/chart.js/Chart.min.js'></script>
    <script src='../dependencias/vendor/datatables/jquery.dataTables.js'></script>
    <script src='../dependencias/vendor/datatables/dataTables.bootstrap4.js'></script>


    <script src='../dependencias/js/sb-admin.min.js'></script>
    <script src='../dependencias/js/demo/chart-area-demo.js'></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="../assets/panel_common.js"></script>
    <script src="../assets/panel_agente.js"></script>
</body>

</html>
<?php 
if (isset($_GET['invalid_params'])) : ?>
    <script>
        alert("Alguns dados não foram preenchidos");
    </script>
    <?php unset($_GET['invalid_params']);
endif; 
if(isset($_GET['page'])):
    if($_GET['page'] == 'reserva'): ?>
        <script>
            loadReserveForm('<?=$_GET['ambiente']?>')
        </script>
    <?php endif ?>
<?php endif ?>