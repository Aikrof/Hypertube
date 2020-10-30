"use strict"

global._ = require('lodash');

global.fs = require('fs');

const dotenv = require('dotenv')
    .config({
        path: fs.realpathSync(__dirname + '/../../.env')
    });
global.env = dotenv.parsed;

global.axios = require('axios');
