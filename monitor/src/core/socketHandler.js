const logger = require('./Logger')('MONITOR->WEBSOCKET');

function socketHandler(io){
    io.on("connection", socket => {
       logger.log(`${socket.id} connected`);
       socket.on('isMonitor', data => {
           logger.log(`${socket.id} is the monitor!`)
       })
    })
}

module.exports = socketHandler;