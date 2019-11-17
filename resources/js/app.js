/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Jwt = require('./JwtToken.js');
window.Vue = require('vue');
const Token = require('./apdateToken.js').default;
const VueRouter = require('vue-router').default;
const store = require('./store/VuexStore').default;

Vue.use(VueRouter);
Vue.config.devtools = false;
Vue.config.productionTip = false;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('auth-component', require('./components/Auth/AuthComponent.vue').default);
// Vue.component('login-component', require('./components/Auth/LoginComponent.vue').default);
// Vue.component('register-component', require('./components/Auth/RegisterComponent.vue').default);
// Vue.component('logo-component', require('./components/Auth/LogoComponent.vue').default);

if (Token.needToApdate()){
    Token.refresh(function(){vueRun();});
}
else {
    vueRun();
}

function vueRun() {

    let router = new VueRouter({
        routes: [
            {path: '/', component: require('./views/IndexPage.vue').default},
            {path: '/landing', component: require('./views/LandingPage.vue').default},
            {path: '/movie/:id', component: require('./views/MoviePage.vue').default, props:true}
        ],
        mode: 'history',
    });
    router.beforeEach((to, from, next) => {
        let exist = Jwt.tokenExist();

        if (to.path === '/landing' && exist)
            router.push('/');
        else if (to.path !== '/landing' && !exist)
            router.push('/landing');
        else
            next();
    });

    /**
     * Next, we will create a fresh Vue application instance and attach it to
     * the page. Then, you may begin adding components to this application
     * or customize the JavaScript scaffolding to fit your unique needs.
     */
    const app = new Vue({
        el: '#app',
        router: router,
        store: store,
    });
}
