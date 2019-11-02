"use strict";

function JwtAuth(){
    let $token;
    let $refresh;

    this.getToken = function(){
        return this.$token;
    }

    this.getRefresh = function(){
        return this.$refresh;
    }

    this.setTokens = function(data){
        this.$token = data.token;
        this.$refresh = data.refresh;
    }

    this.saveCookie = function(tokenData){
        // let date = new Date();
        //
        // date.setTime(tokenData.token_expires_at * 1000);
        // let exp = date.toUTCString();
        document.cookie = 'Authorization=' +
            tokenData.token_type + ' ' + tokenData.token +
            ';path=/;expires=' + exp(tokenData.token_expires_at) +
            ';samesite';

        // date.setTime(tokenData.refresh_expires_at * 1000);
        // exp = date.toUTCString();
        document.cookie = 'Authenticate=' +
            tokenData.refresh +
            ';path=/;expires=' + exp(tokenData.refresh_expires_at) +
            ';samesite';
    }

    let exp = function(timestamp){
        let date = new Date();
        date.setTime(timestamp * 1000);
        console.log(date.toUTCString());
        return (date.toUTCString());
    }
}

let $jwt = new JwtAuth;

(function(){
    function getCookie(name){
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    let $data = {
        'token': getCookie('Authorization'),
        'refresh': getCookie('Authenticate')
    }

    $jwt.setTokens($data);

}());

module.exports = $jwt;

