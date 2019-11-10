"use strict"

import Vuex from 'vuex'
import user from './modules/user'
import films from './modules/movies.js'

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        user, films,
    }
});
