async function loadReserveForm() {
    let req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('indextable').innerHTML = req.responseText;
            document.getElementById('content-name').innerText = '📅 Nova reserva';
        }
    }

    req.open('GET', `../cadastro/reserva.php`, true);
    req.send();

}

var storedEnv;

async function loadReserveFormCalendar() {

    var ambiente = document.getElementById('ambiente').value
    var calendarEl = document.getElementById('calendar');
    calendarEl.innerHTML = "";

    const eventsURL = `../actions/listar_reservas.php?ambiente=${ambiente}`

    data = await fetch(eventsURL);


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
            $('#reserve-modal').modal({});;
            const end = formatDate(info.end)
            const start = formatDate(info.start)
            document.getElementById('inicio').value = start;
            document.getElementById('fim').value = end;
        }
    });

    calendar.render();
}

async function loadUserData() {
    const id = document.getElementById('user_id').value
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

function loadSearch(env = 'todos', prof = 'todos', agente = 'todos') {
    let req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('indextable').innerHTML = req.responseText;
            document.getElementById('content-name').innerText = '📅 Buscar reservas';
        }
    }

    req.open('GET', `../actions/filtrar_reservas.php?ambiente=${env}&agente=${agente}&prof=${prof}`, true);
    req.send();
}


async function loadReserves() {
    const env = document.getElementById('ambiente').value;
    const rvt = document.getElementById('reservista').value;
    const agt = document.getElementById('agente').value;


    var calendarEl = document.getElementById('calendar');
    calendarEl.innerHTML = "";

    const eventsURL = `../actions/listar_reservas.php?ambiente=${env}&prof=${rvt}&agente=${agt}`

    data = await fetch(eventsURL);

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        plugins: ['timeGrid'],
        defaultView: 'timeGridWeek',
        minTime: "07:45:00",
        maxTime: "22:30:00",
        events: eventsURL,
        eventClick: function (info) {
            alert('Event: ' + formatDate(info.event.start));
        }
    });

    calendar.render();
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