import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        token: localStorage.getItem('access_token') || null,
        errors:[],
        success:[],

        api: {
            orders: {
                index: 'http://shop.test/api/v1/orders',
                show: null,
                destroy: null
            }
        },
        orderLoadedData:null,
        ordersLoadedData: {
            data: [],
            meta: []
        }
    },
    mutations: {

        setApiUrl(state, content) {
            state.api[content.base][content.page] = content.url;
        },

        //orders
        setOrderData(state, content) {
            state.orderLoadedData = content;
            state.success.push(new Date().getHours() +':'+new Date().getMinutes()+' ' + content.message)             //DEBUG
        },
        setOrdersData(state, content) {
            state.ordersLoadedData = content;
            state.success.push(new Date().getHours() +':'+new Date().getMinutes()+' ' + content.message)             //DEBUG
        },
        setOrdersCurrentPage(state, page) {
            state.ordersLoadedData.meta.current_page = page;
        },
        // end orders

        //error success messages
        createErrorMessage(state, message){
            state.errors.push(message)
        },
        deleteError(state, index){
            state.errors.splice(index, 1);
        },
        createSuccessMessage(state, message){
            state.success.push(message)
        },
        deleteSuccess(state, index){
            state.success.splice(index, 1);
        },
        //end error

        retrieveToken(state, token) {
            state.token = token;
        },
        destroyToken(state) {
            state.token = null;
        },
    },
    getters: {
        loggedIn(state) {
            return state.token !== null;
        },
        hasErrors(state){
            return state.errors;
        }
    },
    actions: {
        getOrder(context) {
            return new Promise((resolve, reject) => {
                axios.get(this.state.api.orders.show).then(response => {
                    const content = response.data
                    context.commit('setOrderData', content)
                    resolve(response)
                }).catch(error => {
                    reject(error)
                })
            })
        },

        getOrders(context, credentials) {
            return new Promise((resolve, reject) => {
                axios.get(this.state.api.orders.index, {
                    params: {
                        page: credentials.page,
                    }
                }).then(response => {
                    const content = response.data
                    context.commit('setOrdersData', content)
                    resolve(response)
                }).catch(error => {
                    reject(error)
                })
            })
        },
        // token
        retrieveToken(context, credentials) {
            return new Promise((resolve, reject) => {
                axios.post('http://shop.test/api/v1/login', {
                    email: credentials.email,
                    password: credentials.password,
                }).then(response => {
                    const token = response.data.access_token
                    localStorage.setItem('access_token', token)
                    context.commit('retrieveToken', token)
                    resolve(response)
                }).catch(error => {
                    reject(error)
                })
            })
        },
        logout: (context) => {
            return new Promise((resolve) => {
                context.commit('destroyToken')
                localStorage.removeItem('access_token') // clear your user's token from localstorage
                resolve()
            })
        }
    },
    modules: {}
})
