const express = require('express');
const http = require('http');
const path = require('path');
const cors = require('cors');
const socketio = require('socket.io');

const routes = require('./routes');
const Logger = require('./Logger');
const socketHandler = require('./socketHandler');


function Monitor(log = false, defaultLogger = Logger, router = routes) {

    const logger = log ? defaultLogger(defaultAuthor = "MONITOR") : { log: () => { } };
    
    let listener;
    let server;
    let io;

    function start() {
        listener = express();
        server = http.createServer(listener);
        io = socketio(server);
        run();
    }

    function run() {
        listener.use(cors());
        listener.use(router);
        socketHandler(io, logger);
        server.listen(3333, "localhost", () => {
            logger.clear();
            logger.log("Using port 3333");
        });
    }

    return {
        start
    }
}

module.exports = Monitor;