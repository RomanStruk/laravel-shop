/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Basket from "./components/Basket";

require('./bootstrap');

window.Vue = require('vue');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import vSelect from 'vue-select';
Vue.component("v-select", vSelect);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('shop-component', require('./components/Shop.vue').default);
Vue.component('basket-component', require('./components/Basket.vue').default);
Vue.component('your-order-component', require('./components/YourOrderComponent.vue').default);
Vue.component('basket-button-component', require('./components/product/BasketButton.vue').default);
Vue.component('comments-component', require('./components/product/Comments.vue').default);
Vue.component('check-out-form-shipping', require('./components/checkout/CheckOutFormShipping.vue').default);
Vue.component('check-out-form-main', require('./components/checkout/CheckOutFormMain.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import reactiveStorage from "vue-reactive-storage";
Vue.use(reactiveStorage, {
    basket_list:[],
    basket_list_sum: 0
});

const app = new Vue({
    el: '#app',
});
