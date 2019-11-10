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
            let url = '/api/user/' + Jwt.getSub();
            axios.get(url, Jwt.getHeaders())
                .then(response => {
                    console.log(response.data);
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
