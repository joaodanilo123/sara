<?php

session_start();
require '../config/conexao.php';
$agente_id = $_SESSION['id'];

function carregar_profs(mysqli $conn)
{
    $sql = "SELECT usuario_nome, usuario_id FROM usuario WHERE hierarquia_nome='professor'";
    $query = $conn->query($sql);
    $result = array();
    while ($row = $query->fetch_assoc()) {
        array_push($result, $row);
    }

    return $result;
}

function carregar_ambientes(mysqli $conn)
{
    $sql = "SELECT ambiente_nome, ambiente_id FROM ambiente";
    $query = $conn->query($sql);
    $result = array();
    while ($row = $query->fetch_assoc()) {
        array_push($result, $row);
    }

    return $result;
}

$ad = carregar_ambientes($connection);
$pd = carregar_profs($connection);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        form {
            border: 1px solid grey;
            border-radius: 5px;
            padding: 40px;
        }

        .borded-strong {
            border: 3px solid black
        }
    </style>
    <link rel="stylesheet" href="../dependencias/fullcalendar-4.1.0/packages/core/main.min.css">
    <link rel="stylesheet" href="../dependencias/fullcalendar-4.1.0/packages/daygrid/main.min.css">
    <link rel="stylesheet" href="../dependencias/fullcalendar-4.1.0/packages/timegrid/main.min.css">
    <script src="../dependencias/fullcalendar-4.1.0/packages/core/main.min.js"></script>
    <script src="../dependencias/fullcalendar-4.1.0/packages/daygrid/main.min.js"></script>
    <script src="../dependencias/fullcalendar-4.1.0/packages/timegrid/main.min.js"></script>
    <script src="../dependencias/fullcalendar-4.1.0/packages/core/locales/pt-br.js"></script>
    <script>
        var calendar;

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'pt-br',
                plugins: ['timeGrid'],
                defaultView: 'timeGridWeek',
                minTime: "07:45:00",
                maxTime: "22:30:00",
                slotDuration: '00:20:00',
                
                height: 500
            });

            calendar.render();
        });

        function setEvents(){
            const ambiente = document.getElementById('ambiente').value;
            calendar.getEvents().forEach(event => {
                event.remove();
            });
            
            calendar.addEventSource(`../actions/listar_reservas.php?ambiente=${ambiente}`);
        }

    </script>
    <title>Reservar</title>
</head>

<body>
    <main class="container">
        <form action="../actions/reservar.php" method="post">
            <header>
                <h1>Reservar ambiente</h1>
            </header>
            <fieldset class="form-group">
                <label for="ambiente">Ambiente</label>
                <select name="ambiente" id="ambiente" class="form-control" onchange="setEvents()">
                    <option disabled selected>Selecione um ambiente</option>
                    <?php foreach ($ad as $data) : ?>
                        <option value="<?= $data['ambiente_id'] ?>"><?= $data['ambiente_nome'] ?></option>
                    <?php endforeach ?>
                </select>
            </fieldset>
            <fieldset class="form-group">
                <label for="professor">Reservista:</label>
                <select name="professor" id="professor" class="form-control">
                    <option disabled selected>Selecione um professor</option>
                    <?php foreach ($pd as $data) : ?>
                        <option value="<?= $data['usuario_id'] ?>"><?= $data['usuario_nome'] ?></option>
                    <?php endforeach ?>
                </select>
            </fieldset>
            <section class="form-row">
                <fieldset class="form-group col-m6">
                    <label for="inicio">Início:</label>
                    <input type="datetime-local" name="inicio" id="inicio">
                </fieldset>
                <fieldset class="form-group col-m6">
                    <label for="fim">Fim:</label>
                    <input type="datetime-local" name="fim" id="fim">
                </fieldset>
            </section>
            <fieldset class="form-row">
                <label for="color">Cor de exibição no calendário</label>
                <select name="color" class="form-control" id="color">
                    <option disabled selected>Selecione</option>
                    <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                    <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                    <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                    <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                    <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                    <option style="color:#436EEE;" value="#436EEE">Azul Royal</option>
                    <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                    <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                    <option style="color:#228B22;" value="#228B22">Verde</option>
                    <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                </select>
            </fieldset>
            <br>
            <div id="calendar" class="borded-strong"></div>
            <br>
            <input type="submit" value="Reservar" class="col btn btn-primary">
        </form>
    </main>
</body>
<script src="../dependencias/jquery/dist/jquery.min.js"></script>
<script src="../dependencias/bootstrap/js/bootstrap.min.js"></script>
<?php if(isset($_GET['invalid_params'])):?>
    <script>
        alert("Alguns dados não foram preenchidos");
    </script>
<?php unset($_GET['invalid_params']); endif; ?>
</html>