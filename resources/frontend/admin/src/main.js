

import Vue from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'
import vuetify from './plugins/vuetify';
import Axios from 'axios'

Vue.prototype.$http = Axios;

const token = store.state.token;
Vue.prototype.$http.defaults.baseURL = 'http://shop.test/api/v1'
if (token) {
    Vue.prototype.$http.defaults.headers.common['Authorization'] = 'Bearer '+token
}
Vue.config.productionTip = false

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
