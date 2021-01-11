/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');

import {store} from "./components/store/store";
import vSelect from 'vue-select';
import Vuelidate from 'vuelidate';

window.eventBus = new Vue();


Vue.use(Vuelidate);


Vue.component("v-select", vSelect);
Vue.component('shop-component', require('./components/Shop.vue').default);
Vue.component('shopping-cart-menu-component', require('./components/product/ShoppingCartMenuComponent.vue').default);

Vue.component('comments-component', require('./components/product/Comments.vue').default);
Vue.component('check-out-form-main', require('./components/checkout/CheckOutFormMain.vue').default);
Vue.component('product-component', require('./components/product/ProductComponent').default);




const app = new Vue({
    el: '#app',
    store: store,
});
