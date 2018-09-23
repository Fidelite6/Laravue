require('./bootstrap');

import Vue from 'vue';
import VueResource from 'vue-resource';


// import AdminDashboard from './components/admin/dashboard.vue';
import Articles from './components/Articles.vue';
import AuthVue from './components/auth/auth.vue';
import RegistrationVue from './components/auth/registration.vue';


Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
Vue.http.options.emulateJSON = true;



const app = new Vue({
    el: '#app',

    components: {
        AuthVue,
        RegistrationVue,
        Articles,

        // AdminDashboard
    }

});