"use strict"

module.exports = function ($request, $response, next){
    let magnetLink  = $request.params.magnetLink;

    if (!checkMagnetLink(magnetLink)) {
         return (
             $response
                 .status(400)
                 .json('Invalid torrent magnet link')
         );
    }

    next();
}

let checkMagnetLink = function(magnetLink){
    let regexp = new RegExp(
        /^(magnet:\?xl=[0-9]+)(&xt=urn:btih:[A-z0-9]+)(&tr=[udp | http]+:[\/]{2}([A-z0-9\-_\.\:\/]+))+/
    );

    if (_.isEmpty(magnetLink) || !magnetLink.match(regexp)){
        return (false);
    }

    return (true);
}
