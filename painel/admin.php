<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['id'])) {
    $nome = $_SESSION['nome'];
    $id = $_SESSION['id'];
    include_once "../config/conexao.php";
} else {
    header("./login.php");
}

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
</head>

<body id="page-top">
    <nav class='navbar navbar-expand navbar-dark bg-dark static-top'>

        <a class='navbar-brand mr-1' href='./admin.php'>🔓 <?= $nome ?></a>

        <ul class='navbar-nav ml-auto ml-md-0'>
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
                    <h6 class='dropdown-header'>Opções:</h6>
                    <a class='dropdown-item' href='indexadm.php'>Listar</a>
                    <a class='dropdown-item' href='../cadastro/ambiente.php'>Cadastrar</a>
                </div>
            </li>
            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='pagesDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <i class='fas fa-fw'>👥</i>
                    <span>Usuários</span>
                </a>
                <div class='dropdown-menu' aria-labelledby='pagesDropdown'>
                    <h6 class='dropdown-header'>Opções:</h6>
                    <a class='dropdown-item' href='listausu.php'>Listar</a>
                    <a class='dropdown-item' href='cadastrousu.php'>Cadastrar</a>
                </div>
            </li>
        </ul>

        <div id='content-wrapper'>

            <div class='container-fluid'>
                <div class="card mb-3">
                    <div class="card-header"> <i class="fas">🚪</i>Ambientes</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <tr>
                                    <td><b>ID</b></td>
                                    <td><b>Nome</b></td>
                                    <td><b>Número</b></td>
                                    <td><b>Opções</b></td>
                                </tr>

                                <?php

                                $sql = 'SELECT ambiente_id, ambiente_nome, ambiente_numero FROM ambiente';
                                $result = $connection->query($sql);

                                while ($row = $result->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?=$row['ambiente_id']?></td>
                                        <td><?=$row['ambiente_nome']?></td>
                                        <td><?=$row['ambiente_numero']?></td>
                                        <td>deletar</td>
                                    </tr>
                                <?php endwhile; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

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
            <script src='../dependencias/js/demo/datatables-demo.js'></script>
            <script src='../dependencias/js/demo/chart-area-demo.js'></script>
</body>

</html>