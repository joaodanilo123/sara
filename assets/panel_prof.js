function loadReserveForm(_ambiente = false) {
    let req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('indextable').innerHTML = req.responseText;
            document.getElementById('content-name').innerText = '📅 Nova reserva';
            if (_ambiente){
                loadReserveFormCalendar(_ambiente)
            }
        }
    }

    req.open('GET', `../cadastro/requisicao.php`, true );
    req.send();

}

var storedEnv;

async function loadReserveFormCalendar(_ambiente = false) {

    var ambiente = _ambiente || document.getElementById('ambiente').value
    var calendarEl = document.getElementById('calendar');
    calendarEl.innerHTML = "";

    const eventsURL = `../actions/listar_reservas.php?ambiente=${ambiente}`

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        plugins: ['timeGrid', 'interaction'],
        defaultView: 'timeGridWeek',
        minTime: "07:45:00",
        maxTime: "22:30:00",
        selectable: true,
        events: eventsURL,
        eventClick: function (info) {
            alert('Event: ' + info.event.title);
        },

        select: function (info) {
            $('#reserve-modal').modal({})
            const end = formatDate(info.end)
            const start = formatDate(info.start)
            document.getElementById('inicio').value = start;
            document.getElementById('fim').value = end;
        }
    });

    calendar.render();
}

async function loadAmbiData(id) {
    const params = new URLSearchParams();
    params.append('id', id);

    const instance = axios.create({
        baseURL: 'http://localhost/sara/actions',
    });

    const response = await instance.post('/dados_usuario.php', params)

    if (response.status === 200) {
        document.getElementById('indextable').innerHTML = response.data;
        document.getElementById('content-name').innerText = 'Dados do usuário';
    }
}


