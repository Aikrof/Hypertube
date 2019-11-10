"use strict";

function deleteCookie(name){
    let exp = new Date().toUTCString();
    document.cookie = name +
        '=deleted;path=/;expires=' + exp + ';samesite';
}


const refresh = async function refresh(callback){
    try {
        let response = await axios.post('/api/oauth/refresh', "", Jwt.getHeaders());
        if (response.data){
            Jwt.saveCookie(response.data);
            Jwt.setTokens(Jwt.getTokensFromCookie());
            callback();
        }
    }catch(e){
        deleteCookie('Authorization');
        deleteCookie('Authenticate');
        Jwt.setTokens({
            'token': null,
            'refresh': null,
        });
        window.location.href = '/landing';
    }
}

const needToApdate = function(){
    return (Jwt.tokenExist() &&
        !Jwt.checkTtl(Jwt.getToken()) &&
        Jwt.checkTtl(Jwt.getRefresh()));
}

export default {refresh, needToApdate};
