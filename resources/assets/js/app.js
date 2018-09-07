require('./bootstrap');

window.Vue = require('vue');
import VueRouter from "vue-router";

window.Vue.use(VueRouter);

import AdminDashboard from './components/admin/dashboard.vue';

// Vue.component('articles', require('./components/Articles.vue'));
// Vue.component('navbar', require('./components/Navbar.vue'));
// Vue.component('AuthVue', require('./components/auth/auth.vue'));

// const app = new Vue({
//     el: '#app'
// });

const routes = [
    {
        path: '/',
        components: {
            AdminDashboard: AdminDashboard
        }
    },
    // {path: '/admin/companies/create', component: CompaniesCreate, name: 'createCompany'},
    // {path: '/admin/companies/edit/:id', component: CompaniesEdit, name: 'editCompany'},
];

const router = new VueRouter({
    // mode: 'history',    // get out of # in url
    routes
});

const app = new Vue({ router }).$mount('#app');