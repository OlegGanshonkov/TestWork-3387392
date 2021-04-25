/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('bootstrap');

window.Vue = require('vue').default;
window.Bus = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('flash-message', require('./components/FlashMessage.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store';
import "bootstrap/dist/css/bootstrap.min.css"
import VueRouter from 'vue-router'
Vue.use(VueRouter);

import App from './components/App'
import PublicationsList from './components/PublicationsList'
import PublicationsView from './components/PublicationsView'
import PublicationsEdit from './components/PublicationsEdit'
import PublicationsCreate from './components/PublicationsCreate'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/publications',
            name: 'publications.list',
            component: PublicationsList
        },
        {
            path: '/publications/:id',
            name: 'publications.view',
            component: PublicationsView,
        },
        {
            path: '/publications/:id/edit',
            name: 'publications.edit',
            component: PublicationsEdit,
        },
        {
            path: '/publications/:id/edit',
            name: 'publications.edit',
            component: PublicationsEdit,
        },
        {
            path: '/publications/create',
            name: 'publications.create',
            component: PublicationsCreate,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});

