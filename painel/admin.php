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

    <!-- Custom styles for this template-->
    <link href="../dependencias/css/sb-admin.css" rel="stylesheet">
    <style>
        .opcao {
            text-decoration: none;
            transition-property: all;
            transition-duration: 0.2s;
        }

        .opcao:hover {
            font-weight: bold;
            font-size: 1.2rem;
            text-decoration: none;
        }

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
    <script>
        async function loadUsers() {
            let req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById('indextable').innerHTML = req.responseText;
                    document.getElementById('content-name').innerText = '👥 Usuários';
                }
            }

            req.open('GET', '../actions/listar_usuarios.php', true);
            req.send();
        }

        async function loadEnvs() {
            let req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById('indextable').innerHTML = req.responseText;
                    document.getElementById('content-name').innerText = '🚪 Ambientes';
                }
            }

            req.open('GET', '../actions/listar_ambientes.php', true);
            req.send();
        }

        async function loadUserRegisterForm() {
            let req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById('indextable').innerHTML = req.responseText;
                    document.getElementById('content-name').innerText = '👥 Cadastrar Usuário';
                }
            }

            req.open('GET', '../cadastro/usuario.php', true);
            req.send();
        }

        async function loadEnvRegisterForm() {
            let req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById('indextable').innerHTML = req.responseText;
                    document.getElementById('content-name').innerText = '🚪 Cadastrar Ambiente';
                }
            }

            req.open('GET', '../cadastro/ambiente.php', true);
            req.send();
        }

        async function inativateEnv(id) {
            const params = new URLSearchParams();
            params.append('id', id);

            const instance = axios.create({
                baseURL: 'http://localhost/sara/actions',
            });

            try {
                const response = await instance.post('/inativar_ambiente.php', params);
                alert('Ambiente inativado');
                loadEnvs();
            } catch(error) {
                alert('Não foi possivel realizar a operação');
                loadEnvs();
            }
        }

        async function loadEnvReserves(id) {
            
        }
    </script>
</body>

</html>