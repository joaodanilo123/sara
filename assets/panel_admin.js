async function loadUsers() {
    let req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('indextable').innerHTML = req.responseText;
            document.getElementById('content-name').innerText = '👥 Usuários';
        }
    }

    req.open('GET', '../actions/listar_usuarios.php', true);
    req.send();
}

async function loadUserRegisterForm() {
    let req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('indextable').innerHTML = req.responseText;
            document.getElementById('content-name').innerText = '👥 Cadastrar Usuário';
        }
    }

    req.open('GET', '../cadastro/usuario.php', true);
    req.send();
}

async function loadUserEditForm(id) {
    let req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('indextable').innerHTML = req.responseText;
            document.getElementById('content-name').innerText = '👥 Editar Usuário';
        }
    }

    req.open('GET', `../editar/usuario.php?usuario=${id}`, true);
    req.send();
}

async function loadEnvs() {
    let req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('indextable').innerHTML = req.responseText;
            document.getElementById('content-name').innerText = '🚪 Ambientes';
        }
    }

    req.open('GET', '../actions/listar_ambientes.php', true);
    req.send();
}

async function loadEnvRegisterForm() {
    let req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('indextable').innerHTML = req.responseText;
            document.getElementById('content-name').innerText = '🚪 Cadastrar Ambiente';
        }
    }

    req.open('GET', '../cadastro/ambiente.php', true);
    req.send();
}

async function loadEnvEditForm(ambienteId) {
    const params = new URLSearchParams();

    const instance = axios.create({
        baseURL: 'http://localhost/sara/editar',
    });

    try {
        const response = await instance.get(`/ambiente.php?ambiente=${ambienteId}`)
        document.getElementById('indextable').innerHTML = response.data;
        document.getElementById('content-name').innerText = '🚪 Editar Ambiente';
    } catch (error) {

    }
}

function loadBuildings() {
    let req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('indextable').innerHTML = req.responseText;
            document.getElementById('content-name').innerText = '🏢 Prédios';
        }
    }

    req.open('GET', '../actions/listar_predios.php', true);
    req.send();
}

function loadBuildingRegisterForm() {
    let req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('indextable').innerHTML = req.responseText;
            document.getElementById('content-name').innerText = '🏢 Cadastrar Prédio';
        }
    }

    req.open('GET', '../cadastro/predio.php', true);
    req.send();
}

function loadBuildingEditForm() {

}

function loadBuildingEnvs(predioId) {
    let req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('indextable').innerHTML = req.responseText;
            document.getElementById('content-name').innerText = '🚪 Ambientes';
        }
    }

    req.open('GET', `../actions/listar_ambientes.php?predio=${predioId}`, true);
    req.send();
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

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        plugins: ['timeGrid'],
        defaultView: 'timeGridWeek',
        minTime: "07:45:00",
        maxTime: "22:30:00",
        events: eventsURL,
        eventClick: function (info) {
            alert('Event: ' + info.event.title);
        }
    });

    calendar.render();
}

function changeTokenField(){
    if(document.getElementById('professor').checked){
        document.getElementById('token').disabled = false;
    } else {
        document.getElementById('token').disabled = true;
    }
    
}