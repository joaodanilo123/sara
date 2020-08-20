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

    <title>Menu Principal - Administrador</title>

    <!-- Custom fonts for this template-->
    <link href="../dependencias/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../dependencias/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/panel_custom.css">
    <!-- Custom styles for this template-->
    <link href="../dependencias/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="../dependencias/fullcalendar-4.1.0/packages/core/main.min.css">
    <link rel="stylesheet" href="../dependencias/fullcalendar-4.1.0/packages/daygrid/main.min.css">
    <link rel="stylesheet" href="../dependencias/fullcalendar-4.1.0/packages/timegrid/main.min.css">
    <script src="../dependencias/fullcalendar-4.1.0/packages/core/main.min.js"></script>
    <script src="../dependencias/fullcalendar-4.1.0/packages/daygrid/main.min.js"></script>
    <script src="../dependencias/fullcalendar-4.1.0/packages/timegrid/main.min.js"></script>
    <script src="../dependencias/fullcalendar-4.1.0/packages/core/locales/pt-br.js"></script>
</head>

<body id="page-top">
    <nav class='navbar navbar-expand navbar-dark bg-dark static-top'>

        <span class='navbar-brand mr-1' href='./admin.php'>🔓 <?= $_SESSION['nome'] ?></span>

        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>

        <ul class='navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0'>
            <li class='nav-item dropdown no-arrow'>
                <a href='../actions/logout.php'><button type='button' class='btn btn-outline-light'>Logout</button></a>
                </div>
            </li>
        </ul>

    </nav>

    <div id='wrapper'>

        <ul class='sidebar navbar-nav'>
            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='pagesDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <i class='fas fa-fw'>🚪</i>
                    <span>Ambientes</span>
                </a>
                <div class='dropdown-menu' aria-labelledby='pagesDropdown'>
                    <a class='dropdown-item' onclick="loadEnvs()">Listar</a>
                    <a class='dropdown-item' onclick="loadEnvRegisterForm()">Cadastrar</a>
                </div>
            </li>
            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='pagesDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <i class='fas fa-fw'>👥</i>
                    <span>Usuários</span>
                </a>
                <div class='dropdown-menu' aria-labelledby='pagesDropdown'>
                    <h6 class='dropdown-header'>Opções:</h6>
                    <a class='dropdown-item' onclick="loadUsers()">Listar</a>
                    <a class='dropdown-item' onclick="loadUserRegisterForm()">Cadastrar</a>
                </div>
            </li>
            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='pagesDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <i class='fas fa-fw'>🏢</i>
                    <span>Prédios</span>
                </a>
                <div class='dropdown-menu' aria-labelledby='pagesDropdown'>
                    <a class='dropdown-item' onclick="loadBuildings()">Listar</a>
                    <a class='dropdown-item' onclick="loadBuildingRegisterForm()">Cadastrar</a>
                </div>
            </li>
            <li class='nav-item'>
                <a class='nav-link' onclick="loadSearch()">
                    <i class='fas fa-fw'>📅</i>
                    <span>Buscar reservas</span>
                </a>
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
    <script src='../dependencias/js/demo/datatables-demo.js'></script>
    <script src='../dependencias/js/demo/chart-area-demo.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="../assets/panel_admin.js"></script>
</body>

</html>