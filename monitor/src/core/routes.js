const express = require('express');
const Logger = require('./Logger');
const path = require('path');

const routes = express.Router();
const logger = Logger('MONITOR->ROUTER');

routes.use('/js', express.static(path.join(__dirname, "../pages/js/")))

routes.get('/', (req, res) => {
    logger.log("request to /")
    res.sendFile(path.join(__dirname, "../pages/monitor.html"));
})


module.exports = routes;