"use strict"

export default {
    state:{
        user: {},
    },
    getters:{
        getUser: state => state.user,
    },
    actions:{
        getUserData(context){
            if (this.getters.getUser.login)
                return;
            let url = '/api/user/' + Jwt.getSub();
            axios.get(url, Jwt.getHeaders())
                .then(response => {
                    context.commit('loadUser', response.data);
                });
        }
    },
    mutations:{
        loadUser(state, data){
            state.user = data;
        },
        //тест доступ к мутациям в Vuex
        // asd(state, a){

        //     console.log('mutation ' + a);
        // }
    }
}
