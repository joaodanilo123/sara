<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monitor - SARA</title>
  <link href="./dependencias/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="./dependencias/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {

      background-color: #195128;
    }

    nav {
      height: 100%;
      width: 20%;
      background-color: black;
      padding: 5px;
      text-align: center;
      margin: 1rem;
      margin-top: 10rem;
    }

    ul {
      display: block;
      font-size: 3rem;
      background-color: white;
      margin: 0;
      padding: 0;
    }

    main {
      flex: 1;
      margin: 0 auto;
      font-size: 14pt;
      padding: 1rem;
      margin-top: 10rem;
    }

    table {
      border: 3px solid black;
      background-color: white;
    }

    .current {
      background-color: grey;
    }

    h1 {
      color: white;
      text-align: center;
    }

    section {
      display: flex;
      flex-direction: row;
    }
  </style>

</head>

<body>
  <h1><?= date('d/m/Y') ?></h1>

  <section>
    <nav id="rooms-nav"></nav>
    <main class="ctn">

      <table class="table table-bordered">
        <thead>
          <th>Professor</th>
          <th>Descrição</th>
          <th>Inicio</th>
          <th>Fim</th>
        </thead>
        <tbody id="table-data"></tbody>
      </table>
    </main>
  </section>



</body>

<script src='./dependencias/vendor/jquery/jquery.min.js'></script>
<script src='./dependencias/bootstrap/js/bootstrap.min.js'></script>
<script src="./dependencias/axios.min.js"></script>
<script src="./assets/monitor.js"></script>

</html>