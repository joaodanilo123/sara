<?php
  header('Content-Type: text/html; charset=UTF-8');
  //a sessão precisa ser iniciada em cada página
  if (!isset($_SESSION)) {session_start();}
  if (isset($_SESSION['login'])) {
    $id_user_session = $_SESSION['id'];
  }

  $idambiente = $_GET['id'];

  $dbc = mysqli_connect('localhost', 'root', '', 'sara') or die ('Erro ao conectar ao servidor MySQL');
  //$dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die ('Erro ao conectar ao Banco de Dados');
  mysqli_set_charset($dbc,"utf8"); 
  $query_events = "SELECT * FROM reservar WHERE id_ambi = '$idambiente'";
  $result_events = mysqli_query($dbc, $query_events) or die ('Erro ao executar o comando SQL event');

  $query = "SELECT * FROM ambiente WHERE id_ambi = '$idambiente'";
  $result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');
  $row = mysqli_fetch_assoc($result);

  $query2 = "SELECT * FROM usuarios WHERE id_usua = '$id_user_session'";
  $result2 = mysqli_query($dbc, $query2) or die ('Erro ao executar o comando SQL');
  $row2 = mysqli_fetch_assoc($result2);
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Reservar</title>

    <meta charset='utf-8' />
    <link href='modal/css/fullcalendar.min.css' rel='stylesheet' />
    <link href='modal/css/personalizado.min.css' rel='stylesheet' />
    <link href='modal/css/bootstrap.min.css' rel='stylesheet' />
    <link href='packages/core/main.css' rel='stylesheet' />
    <link href='packages/daygrid/main.css' rel='stylesheet' />  
    <link href='packages/timegrid/main.css' rel='stylesheet' />
    <link href='packages/list/main.css' rel='stylesheet' />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="setidioma.php">

    <script src='modal/js/jquery.min.js'></script>
    <script src='modal/js/bootstrap.min.js'></script>
    <script src='modal/js/jquery-ui.min.js'></script>
    <script src='modal/js/moment.min.js'></script>
    <script src='modal/js/fullcalendar.min.js'></script>
    <script src='packages/core/main.js'></script>
    <script src='packages/interaction/main.js'></script>
    <script src='packages/daygrid/main.js'></script>
    <script src='packages/timegrid/main.js'></script>
    <script src='packages/list/main.js'></script>
    <script src='locales/pt-br.js'></script>
    <script src="bootbox/bootbox.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {


        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          locales: 'pt-br',
          plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
          height: 'parent',
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          defaultView: 'dayGridMonth',
          navLinks: true, // can click day/week names to navigate views
          editable: true,
          selectOverlap: false,
          eventLimit: true, // allow "more" link when too many events
          eventTimeFormat: { // like '14:30'
            hour: 'numeric',
            minute: '2-digit',
            meridiem: false
          },

          /*titleFormat: { // will produce something like "Tuesday, September 18, 2018"
            month: 'numeric',
            year: 'numeric',
            day: 'numeric',
            weekday: 'short',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
          },*/
          selectable: true,
          select: function(info) {
            $('#cadastrar #start').val(info.start.toLocaleString());
            $('#cadastrar #end').val(info.end.toLocaleString());
            $('#cadastrar').modal('show');
            /*bootbox.alert({
              message: "<center><b>Cadastrar Reserva</b></center>"
              size: 'small'
            })*/
          },

          eventClick: function(info) {
            var eventObj = info.event;
            /*bootbox.alert({
              message: "<center><b>Informações da Reserva</b></center><br>" + "<b>Título:</b> " + eventObj.title + "<br>" + "<b>Início da Reserva:</b> " + eventObj.start.toLocaleString() + "<br>" + "<b>Término da Reserva:</b> " + eventObj.end.toLocaleString()
              /*size: 'small'
            });*/
            $('#visualizar #idVisualizar' ).val(eventObj.id);
            $('#visualizar #title').val(eventObj.title);
            $('#visualizar #start').val(eventObj.start.toLocaleString());
            $('#visualizar #end').val(eventObj.end.toLocaleString());
            $('#visualizar #description').val(eventObj.description);
            $('#visualizar').modal('show');
          },
          defaultDate: new Date(),

          /*eventRender: function (info){
            var reservista = info.event.extendedProps;
          },*/

          events: [
            <?php                
              while ($row_events = mysqli_fetch_assoc($result_events)) {
                $idUsuario = $row_events['id_rese'];
                $sol = $row_events['reservista'];
                $idusu = $row_events['id_usua'];
                $rep = $row_events['repeticao'];
                ?>

                {
                id: '<?php echo $row_events['id_rese']; ?>',
                id_usua: '<?php echo $row_events['id_usua']; ?>',
                id_ambi: '<?php echo $row_events['id_ambi']; ?>',
                title: '<?php echo $row_events['title']; ?>',
                start: '<?php echo $row_events['start']; ?>',
                end: '<?php echo $row_events['end']; ?>',
                color: '<?php echo $row_events['color']; ?>',
                },
                
                <?php  
              }
            ?>
          ]

        });
        calendar.setOption('locale', 'pt-br');
        calendar.render();
      });
    </script>
    <style>

      html, body {
        overflow: hidden; /* don't do scrollbars */
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
      }

      #calendar-container {
        position: fixed;
        top: 100px;
        left: 0;
        right: 0;
        bottom: 0;
      }

      .fc-header-toolbar {
        /*
        the calendar will be butting up against the edges,
        but let's scoot in the header's buttons
        */
        padding-top: 1em;
        padding-left: 1em;
        padding-right: 1em;
      }
    </style>
  </head>
  <body>

    <div id='calendar-container'>
      <div id='calendar'></div>
    </div>

    <nav style="margin-left: 12px; max-height: 100px; margin-top: -10px;" class="navbar navbar-expand-lg navbar-light bg-light">
      <?php
      echo "<h1 style'font-size: 100px;'>". $row['nome'] ." - ". $row['numero'] ."</h1>";

      if ($row2['id_tipo_usua'] == 1) {
        echo "<a href='indexprof.php'><button class='btn btn-danger' style=' margin-left: 0px; color: white; margin-top: 3px;'>Voltar</button></a>";
      }elseif ($row2['id_tipo_usua'] == 3) {
        echo "<a href='indexap.php'><button class='btn btn-danger' style=' margin-left: 0px; color: white; margin-top: 3px;'>Voltar</button></a>";
      }

      $query3 = "SELECT * FROM usuarios WHERE id_usua = '$idusu'";
      $resultado3 = mysqli_query($dbc, $query3) or die ('Erro ao executar o comando SQL 3');
     // $resultado3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);

      $query4 = "SELECT * FROM reservar WHERE id_rese = '$idUsuario'";
      $result4 = mysqli_query($dbc, $query4) or die ('Erro ao executar o comando SQL 4');
      $row4 = mysqli_fetch_assoc($result4);

      if(!!$resultado3){
        foreach($resultado3 as $item){
          if ($item['id_usua'] == $row4['id_usua']) {
            $nomeu = $item['nome']." ".$item['sobrenome'];
            break;
          }
        }
      }
      ?>
    </nav>


    <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center">Dados do Evento</h4>
          </div>
          <form method="post" action="eventoalt.php">
            <div class="modal-body">
              <div class="form-group row">
                <!--<label class="col-sm-2 col-form-label">Id</label>-->
                <div class="col-sm-10">
                  <input type="hidden" name="id" class="form-control" id="idVisualizar" value="" onkeypress="id">
                  <input type="hidden" name="idambi" id="idambi" value="<?php echo $idambiente ?>">
                  <input type="hidden" name="idus" id="idus" value="<?php echo $id_user_session ?>">
                </div>
              </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Título</label>
                <div class="col-sm-10">
                  <input type="text" name="title" class="form-control" id="title" value="" onkeypress="title">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Solicitante</label>
                <div class="col-sm-10">
                  <input type="text" name="reservista" class="form-control" id="reservista" value="<?php echo $sol ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Início da Reserva</label>
                <div class="col-sm-10">
                  <input type="text" name="start" class="form-control" id="start" onkeypress="DataHora(event, this)">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Fim da Reserva</label>
                <div class="col-sm-10">
                  <input type="text" name="end" class="form-control" id="end" onkeypress="DataHora(event, this)">
                </div>
              </div>
              <!--<div class="form-group row">
                <label class="col-sm-2 col-form-label">Repetições</label>
                <div class="col-sm-10">
                  <input type="number" name="rep" class="form-control" id="rep" value="<?php echo $rep ?>">
                </div>
              </div>-->
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Usuário</label>
                <div class="col-sm-10">
                  <input type="text" name="nomeu" class="form-control" id="nomeu" value="<?php echo $nomeu ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" name="AltEvent" id="AltEvent" value="Alterar" class="btn btn-warning">Alterar</button>
                        <a onclick="excluir(<?php echo $idambiente ?>, <?php echo $id_user_session ?>)" href="javascript:func()"><button id="abrir" class="btn btn-danger">Excluir</button></a>
                    </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center">Dados do Evento</h4>
          </div>
           <input type="hidden" name="id" class="form-control" id="id" >
          <div class="modal-body">
            <form method="post" action="evento.php">
              <input type="hidden" name="iduser" value="<?php echo $id_user_session ?>">
              <input type="hidden" name="idambi" id="idambi" value="<?php echo $idambiente ?>">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Título</label>
                  <div class="col-sm-10">
                      <input type="text" name="title" class="form-control" id="title" placeholder="Título da Reserva">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Solicitante</label>
                  <div class="col-sm-10">
                      <input type="text" name="reservista" class="form-control" id="reservista" placeholder="Nome do Solicitante">
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Cor</label>
                  <div class="col-sm-10">
                      <select name="color" class="form-control" id="color">
                          <option value="">Selecione</option>     
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
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Início da Reserva</label>
                  <div class="col-sm-10">
                      <input type="text" name="start" class="form-control" id="start" onkeypress="DataHora(event, this)">
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Final da Reserva</label>
                  <div class="col-sm-10">
                      <input type="text" name="end" class="form-control" id="end"  onkeypress="DataHora(event, this)">
                  </div>
              </div>
              <!--<div class="form-group row">
                <label class="col-sm-2 col-form-label">Repetições</label>
                <div class="col-sm-10">
                  <input type="number" name="rep" class="form-control" id="rep" value="">
                </div>
              </div>-->
              <div class="form-group row">
                  <div class="col-sm-10">
                      <button type="submit" name="CadEvent" id="CadEvent" value="Cadastrar" class="btn btn-success">Cadastrar</button>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div> 
    <script type="text/javascript">
  
      function excluir(ida, idu){        
        var id = document.getElementById('idVisualizar').value;          
          if (confirm("Excluir reserva?")) {
            var url = "excluir_rese.php?id="+id+"&ida="+ida+"&idu="+idu;
            window.location.href = url;
            alert('Ação Efetuada!');
          }          
      }

      function DataHora(evento, objeto){
        var keypress=(window.event)?event.keyCode:evento.which;
        campo = eval (objeto);
        if (campo.value == '00/00/0000 00:00:00')
        {
          campo.value=""
        }
       
        caracteres = '0123456789';
        separacao1 = '/';
        separacao2 = ' ';
        separacao3 = ':';
        conjunto1 = 2;
        conjunto2 = 5;
        conjunto3 = 10;
        conjunto4 = 13;
        conjunto5 = 16;
        if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19))
        {
          if (campo.value.length == conjunto1 )
          campo.value = campo.value + separacao1;
          else if (campo.value.length == conjunto2)
          campo.value = campo.value + separacao1;
          else if (campo.value.length == conjunto3)
          campo.value = campo.value + separacao2;
          else if (campo.value.length == conjunto4)
          campo.value = campo.value + separacao3;
          else if (campo.value.length == conjunto5)
          campo.value = campo.value + separacao3;
        }
        else
          event.returnValue = false;
      }
    </script>
  </body>
</html>
