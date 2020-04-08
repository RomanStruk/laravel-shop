window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    require('admin-lte'); // Include AdminLTE
    require('./scripts');
} catch (e) {}

// window.axios = require('axios');

// Add the ES2015 formation
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


window.Vue = require('vue');
import Vuex from 'vuex';

Vue.use(Vuex);
const store = new Vuex.Store({
    state: {
        warehouses: {},
    },
    getters: {
        // Here we will create a getter
        WAREHOUSES: state => {
            return state.warehouses;
        },
    },

    mutations: {
        ADD_WAREHOUSE: (state, value) => {
            state.warehouses = value;
        },
        // Here we will create Jenny
    },

    actions: {
        // Here we will create Larry
    }
});
Vue.component('shipping', require('./components/order/Shipping.vue').default);
Vue.component('warehouse', require('./components/order/Warehouse.vue').default);

const app = new Vue({
    el: '#app',
    store,
});


// <!-- AdminLTE dashboard demo (This is only for demo purposes) --> TODO
require('./dashboard');
// <!-- AdminLTE for demo purposes --> TODO
require('./demo');
require('./select2');

