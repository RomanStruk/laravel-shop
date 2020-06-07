/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Basket from "./components/Basket";

require('./bootstrap');

window.Vue = require('vue');

import {store} from "./components/store/store";
import vSelect from 'vue-select';
import Vuelidate from 'vuelidate';
import reactiveStorage from "vue-reactive-storage";

window.eventBus = new Vue();


Vue.use(Vuelidate);

Vue.use(reactiveStorage, {
    basket_list:[],
    basket_list_sum: 0
});

Vue.component("v-select", vSelect);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('shop-component', require('./components/Shop.vue').default);
Vue.component('basket-component', require('./components/Basket.vue').default);
Vue.component('your-order-component', require('./components/checkout/YourOrderProductsComponent.vue').default);
Vue.component('basket-button-component', require('./components/product/BasketButton.vue').default);
Vue.component('comments-component', require('./components/product/Comments.vue').default);
Vue.component('check-out-form-shipping', require('./components/checkout/CheckOutFormShipping.vue').default);
Vue.component('check-out-form-main', require('./components/checkout/CheckOutFormMain.vue').default);




const app = new Vue({
    el: '#app',
    store: store,
});
