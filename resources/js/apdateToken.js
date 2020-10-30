"use strict";

const refresh = async function refresh(callback){
    try {
        let response = await axios.post('/api/oauth/refresh', "", Jwt.getHeaders());
        if (response.data){
            Jwt.saveCookie(response.data);
            Jwt.setTokens(Jwt.getTokensFromCookie());
            callback();
        }
    }catch(e){
        Jwt.unsetToken();
        window.location.href = '/landing';
    }
}

const needToApdate = function(){
    return (Jwt.tokenExist() &&
        !Jwt.checkTtl(Jwt.getToken()) &&
        Jwt.checkTtl(Jwt.getRefresh()));
}

export default {refresh, needToApdate};
