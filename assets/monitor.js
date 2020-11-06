const AXIOS = axios.create({
    baseURL: "http://localhost/sara/actions"
})

const table = document.getElementById('table-data');
const nav = document.getElementById('rooms-nav');
const title = document.getElementById('title');
var currentRoom = 0;
var rooms = []
var data = {}

async function getData() {
    reserves = await AXIOS.get('/checar_horario.php');
    data = reserves.data;
    rooms = getRooms(data);
}

function getRooms(data) {
    let rooms = []
    data.forEach(element => {
        if(!rooms.find(r => r == element.sala)){
            rooms.push(element.sala);
        }
    });

    return rooms;
}

async function render(data, room) {
    table.innerHTML = '';
    nav.innerHTML = '';

    rooms.forEach((room, i) => {
        let html = `<ul>${room}</ul>`;
        if(i == currentRoom) html = `<ul class="current">${room}</ul>`;
        nav.innerHTML += html;
    })

    data.forEach(element => {
        if (element.sala == room) {
            let html = '<tr>';
            html += `<td>${element.professor}</td>`;
            html += `<td>${element.descricao}</td>`;
            html += `<td>${element.inicio}</td>`;
            html += `<td>${element.fim}</td>`;
            html += '</tr>';

            table.innerHTML += html;
            html = '';
        }
    });

    currentRoom = rotateRooms(rooms);
}

function rotateRooms(r){
    return r.length - 1 == currentRoom ? 0 : currentRoom + 1;
}

getData().then(() => render(data, rooms[currentRoom]));

setInterval(getData, 5000);

setInterval(()=>{
    render(data, rooms[currentRoom]);
}, 10000);