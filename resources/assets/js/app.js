import Vue from 'vue'
import Buefy from 'buefy'
import {ClientTable} from 'vue-tables-2';
import UsersTable from "./components/UsersTable"

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.use(Buefy);
Vue.use(ClientTable, {}, false, "bulma", "default");

Vue.component("users-table", UsersTable);

new Vue({el: '#app'});

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}