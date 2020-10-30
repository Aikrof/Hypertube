"use strict"

const torrentStream = require('torrent-stream');

const getStreamOptions = function(){
    return ({
        connections: 100,
        uploads: 10,
        tmp: '/../../tmp',
        path: '/../../tmp/test',
        dth: true,
        tracker: false,
    });
}

const getTorrentFile = function(files){
    return (
        files.reduce(function(f1, f2){
            return f1.length > f2.length ? f1 : f2;
        })
    );
}

const getfileData = function(rangeHeader, file){
    let range = rangeHeader.replace(/bytes=/, "").split("-");
    let total = file.length;
    let start = parseInt(range[0], 10);
    let end = range[1] ? parseInt(range[1], 10) : total - 1;

    return ({
        'total': total,
        'start': start,
        'end': end
    });
}

const pipeStream = function($response, fileRange, readStream){
    $response
        .status(206)
        .header('Content-Range', 'bytes ' + fileRange.start + '-' + fileRange.end + '/' + fileRange.total)
        .header('Accept-Ranges', 'bytes')
        .header('Cache-Control', 'no-cache, no-store')
        .header('Content-Length', (fileRange.end - fileRange.start) + 1)
        .header('Content-Type', 'video/mp4');

    readStream.pipe($response);
}

const readStream = function($request, $response, file){

    let fileRange = getfileData($request.headers.range, file);

    let readStream = file.createReadStream({
        start: fileRange.start,
        end: fileRange.end
    });

    pipeStream($response, fileRange, readStream);
}

module.exports = function ($request, $response){
   let magnet = decodeURIComponent($request.params.magnetLink);
   let stream = torrentStream(magnet, getStreamOptions());

   stream.on('ready', () => {
       let file = getTorrentFile(stream.files);

       readStream($request, $response, file);
    });

    $response.on('close', () => {
        stream.destroy();
    });
}
