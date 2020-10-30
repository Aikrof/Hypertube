"use strict";

const router = require('express').Router();
const TorrentStreamController = require('../app/Controller/TorrentStreamController');

// router.use(require('../app/Middleware/Authenticate'));
router
    .use(
        '/api/v1/torrent-stream/:magnetLink',
        require('../app/Middleware/CheckMagnetLink')
    )
    .get(
        '/api/v1/torrent-stream/:magnetLink',
        TorrentStreamController
    );

router.get('*', (req, res) => {
   return (res.sendStatus(404));
});

module.exports = router;