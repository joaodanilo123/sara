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

function loadSearch(env = 'todos', prof = 'todos', agente = 'todos') {
    let req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('indextable').innerHTML = req.responseText;
            document.getElementById('content-name').innerText = '🔎 Buscar reservas';
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

    const reserves = await getEvents(eventsURL) || [];

    let events = [];
    reserves.forEach(reserve => {
        events.push(reserve.event)
    });

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        plugins: ['timeGrid'],
        defaultView: 'timeGridWeek',
        minTime: "07:45:00",
        maxTime: "22:30:00",
        events: events,
        eventClick: info => {
            reserve = reserves.find(r => r.id == info.event.id)

            alert(`${reserve.descricao}\n${reserve.prof}\n${reserve.ambiente}`)
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

async function getEvents(url){
    return fetch(url)
        .then(res => res.json())
        .then(data => data)
}