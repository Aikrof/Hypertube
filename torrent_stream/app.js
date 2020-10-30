"use strict";

require('./config/service_provider');

const express = require('express');
const app = express();
const cors = require('cors');
const bodyParser = require('body-parser');

app.use(cors());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(require('./routes/route'));

app.listen(env.APP_TORRENT_STREAM_PORT || 3000);

