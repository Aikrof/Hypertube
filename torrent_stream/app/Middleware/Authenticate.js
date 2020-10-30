"use strict"

function getJWTHeaders(headers){
    let {authorization, authenticate} = headers;
    return ({
        headers: {
            'Authorization': authorization,
            'Authenticate': authenticate,
        }
    });
}

module.exports = ($request, $response, next) => {
    let url = env.APP_URL + '/api/user/1';
    axios.get(url, getJWTHeaders($request.headers))
        .then(response => {
            console.log(response.data);
            next();
        })
        .catch(error => {
            let err = error.response;
            $response
                .status(err.status)
                .json(err.statusText);
        });
};
