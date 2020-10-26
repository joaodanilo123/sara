const AXIOS_INSTANCE = axios.create({
    baseURL: 'http://localhost/sara/',
});

const INDEXTABLE = document.getElementById('indextable');
const CONTENT_TITLE = document.getElementById('content-name');

function changeContent(html, title) {
    INDEXTABLE.innerHTML = html;
    CONTENT_TITLE.innerText = title;
}

async function requestContent(url){
    try {
        const response = await AXIOS_INSTANCE.get(url);
        return response.data;
    } catch (error) {
        console.error(error);
        return false;
    }
}

async function loadUserData() {
    const id = document.getElementById('user_id').value
    requestContent(`/actions/dados_usuario.php?id=${id}`).then(content => {
        changeContent(content, '👥 Dados Usuário');
    });
}

function loadSearch(env = 'todos', prof = 'todos', agente = 'todos') {
    requestContent(`/actions/filtrar_reservas.php?ambiente=${env}&agente=${agente}&prof=${prof}`).then(content => {
        changeContent(content, '📅 Buscar reservas');
    });
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

