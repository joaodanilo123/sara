function loadReserveForm(_ambiente = false) {
    requestContent(`/cadastro/requisicao.php`).then(content => {
        changeContent(content, '📅 Buscar reservas');
        if (_ambiente){
            loadReserveFormCalendar(_ambiente);
        }
    });
}

async function loadReserves() {
    const env = document.getElementById('ambiente').value;
    const rvt = document.getElementById('reservista').value;
    const agt = document.getElementById('agente').value;


    var calendarEl = document.getElementById('calendar');
    calendarEl.innerHTML = "";

    const eventsURL = `../actions/listar_reservas.php?ambiente=${env}&prof=${rvt}&agente=${agt}`

    const events = await getEvents(eventsURL) || [];

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        plugins: ['timeGrid'],
        defaultView: 'timeGridWeek',
        minTime: "07:45:00",
        maxTime: "22:30:00",
        events: events,
        eventClick: info => {
            const reserve = info.event.extendedProps;
            alert(`${reserve.descricao}\n${reserve.prof}\n${reserve.ambiente}`)
        }
    });

    calendar.render();
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


