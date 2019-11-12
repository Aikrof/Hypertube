"use strict";

const base64url = require('base64url');

function getCookie(name){
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function deleteCookie(name){
    let exp = new Date().toUTCString();
    document.cookie = name +
        '=deleted;path=/;expires=' + exp + ';samesite';
}

function JwtAuth(){
    let $token;
    let $refresh;
    this.apdate = false;

    this.getToken = function(){
        return this.$token;
    }

    this.getRefresh = function(){
        return this.$refresh;
    }

    this.getSub = function(){
        return (
            payload(this.$token).sub
        );
    }

    this.checkTtl = function(token){
        let exp = payload(token).exp;
        let current = Math.round((new Date()).getTime() / 1000);

        return (exp > current);
    }

    this.tokenExist = function(){
        return !!this.$token;
    }

    this.setTokens = function(data){
        this.$token = data.token;
        this.$refresh = data.refresh;
    }

    this.getHeaders = function(){
        return ({
            headers: {
                'Authorization': this.$token,
                'Authenticate': this.$refresh
            }
        });
    }

    this.saveCookie = function(tokenData){
        document.cookie = 'Authorization=' +
            tokenData.token_type + ' ' + tokenData.token +
            ';path=/;expires=' + exp(tokenData.refresh_expires_at) +
            ';samesite';

        document.cookie = 'Authenticate=' +
            tokenData.refresh +
            ';path=/;expires=' + exp(tokenData.refresh_expires_at) +
            ';samesite';
    }

    this.getTokensFromCookie = function(){
        let $data = {
            'token': getCookie('Authorization'),
            'refresh': getCookie('Authenticate')
        }
        return ($data);
    }

    this.unsetToken = function(){
        deleteCookie('Authorization');
        deleteCookie('Authenticate');
        this.$token = null;
        this.$refresh = null;
    }

    let exp = function(timestamp){
        let date = new Date();
        date.setTime(timestamp * 1000);
        return (date.toUTCString());
    }

    let payload = function(token){
        return (
            JSON.parse(base64url.decode(token.split('.')[1]))
        );
    }
}

let $jwt = new JwtAuth;
$jwt.setTokens($jwt.getTokensFromCookie());


module.exports = $jwt;
