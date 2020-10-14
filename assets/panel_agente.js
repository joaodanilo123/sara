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

    req.open('GET', `../cadastro/reserva.php`, true );
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
    
        select: function (info) {
            $('#reserve-modal').modal({});;
            const end = formatDate(info.end)
            const start = formatDate(info.start)
            document.getElementById('inicio').value = start;
            document.getElementById('fim').value = end;
        }
    });

    calendar.render();
}

var calendar;

async function loadReserves() {
    const env = document.getElementById('ambiente').value;
    const rvt = document.getElementById('reservista').value;
    const agt = document.getElementById('agente').value;


    var calendarEl = document.getElementById('calendar');
    calendarEl.innerHTML = "";

    const eventsURL = `../actions/listar_reservas.php?ambiente=${env}&prof=${rvt}&agente=${agt}`

    const reserves = await getEvents(eventsURL) || [];

    let events = [];
    reserves.forEach(reserve => {
        events.push(reserve.event)
    });

    calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        plugins: ['timeGrid'],
        defaultView: 'timeGridWeek',
        minTime: "07:45:00",
        maxTime: "22:30:00",
        events: events,
        eventClick: async info => {
            eventID = info.event.id;
            currentEvent = calendar.getEventById(eventID);
            if(info.event.backgroundColor == '#bcbcbc'){
                if(confirm("Confimar reserva?")){
                    confirmation = await confirmReserve(eventID);
                    if(confirmation.ok == 1){
                        alert('Reserva confirmada.');
                        currentEvent.setProp('backgroundColor', confirmation.color)
                    }
                }
            }
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


function formatDate(date) {
    date = new Date(date).toLocaleString();
    const D = date.slice(0, 2);
    const M = date.slice(3, 5);
    const Y = date.slice(6, 10);
    const h = date.slice(11, 13);
    const m = date.slice(14, 16);
    return `${Y}-${M}-${D}T${h}:${m}`;
}

async function confirmReserve(reserve_id){
    const params = new URLSearchParams();
    params.append('id', reserve_id);

    const instance = axios.create({
        baseURL: 'http://localhost/sara/actions',
    });

    const response = await instance.post('/confirmar_reserva.php', params);

    return response.data;
}