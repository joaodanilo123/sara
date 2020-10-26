async function loadUsers() {
    requestContent(`/actions/listar_usuarios.php`).then(content => {
        changeContent(content, '👥 Usuários');
    });
}

async function loadUserRegisterForm() {
    requestContent(`/cadastro/usuario.php`).then(content => {
        changeContent(content, '👥 Cadastrar Usuário');
    });
}

async function loadUserEditForm(userId) {
    requestContent(`/editar/usuario.php?usuario=${userId}`).then(content => {
        changeContent(content, '👥 Editar Usuário');
    });
}

async function loadEnvs() {
    requestContent(`/actions/listar_ambientes.php`).then(content => {
        changeContent(content, '🚪 Ambientes');
    });
}

async function loadEnvRegisterForm() {
    requestContent(`/cadastro/ambiente.php`).then(content => {
        changeContent(content, '🚪 Novo Ambiente');
    });
}

async function loadEnvEditForm(ambienteId) {
    requestContent(`/editar/ambiente.php?ambiente=${ambienteId}`).then(content => {
        changeContent(content, '🚪 Editar Ambiente');
    });
}

async function loadBuildings() {
    requestContent(`/actions/listar_predios.php`).then(content => {
        changeContent(content, '🏢 Prédios');
    });
}

function loadBuildingRegisterForm() {
    requestContent(`/cadastro/predio.php`).then(content => {
        changeContent(content, '🏢 Cadastrar Prédio');
    });
}

function loadBuildingEditForm() {

}

function loadBuildingEnvs(predioId) {
    requestContent(`/actions/listar_ambientes.php?predio=${predioId}`).then(content => {
        changeContent(content, '🚪 Ambientes');
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

    calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        plugins: ['timeGrid'],
        defaultView: 'timeGridWeek',
        minTime: "07:45:00",
        maxTime: "22:30:00",
        events: events,
        eventClick: async info => {
            alert(info.event.extendedProps.descricao); 
        }
    });

    calendar.render();
}

function changeTokenField() {
    const tokenField = document.getElementById('token');
    const profFieldChecked = document.getElementById('professor').checked;
    tokenField.disabled = !profFieldChecked ? true : false;
}

async function getEvents(url) {
    return fetch(url)
        .then(res => res.json())
        .then(data => data)
}