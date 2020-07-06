/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import App from './App.vue'
import router from './router'
import Swal from 'sweetalert2'

import Vuetify from "../plugins/vuetify";

import store from "./store"



// Install Bootstrap Template
require('./bootstrap');
// Install Vue
window.Vue = require('vue');

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});

const Howl = require('howler');

window.Toast = Toast;
window.Swal =  Swal;



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component('my-button', require('./components/ExampleComponent.vue').default);
Vue.component('sound-notification', require('./components/SoundNotification.vue').default);
Vue.component('mtickets-counter', require('./components/MTicketsCounter.vue').default);



Vue.component('side-bar', require('./components/layouts/SideBar').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//
new Vue({
    el: '#app',
    vuetify: Vuetify,
    components: { App },
    template: '<App/>',
    router,
    store,
});



