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
            order: {
                index: 'http://shop.test/api/v1/admin/order',
                show: null,
                destroy: null
            },
            category: {
                index: 'http://shop.test/api/v1/admin/category',
                show: null,
                destroy: null
            },
            product: {
                index: 'http://shop.test/api/v1/admin/product',
                show: null,
                destroy: null
            },
            user: {
                index: 'http://shop.test/api/v1/admin/user',
                show: null,
                destroy: null
            },
            media: {
                index: 'http://shop.test/api/v1/admin/media',
                show: null,
                destroy: null
            },
            filter: {
                index: 'http://shop.test/api/v1/admin/filter',
                show: null,
                destroy: null
            },
            supplier: {
                index: 'http://shop.test/api/v1/admin/supplier',
                show: null,
                destroy: null
            },
            syllable: {
                index: 'http://shop.test/api/v1/admin/syllable',
                show: null,
                destroy: null
            }
        },

        // api loaded storage
        apiLoadedData: {},

        snake:{
            snackStatus: false,
            snackText: '',
            snackColor: ''
        }
    },
    mutations: {
        SET_API_LOADED_DATA(state, content) {
            state.apiLoadedData = content;
        },
        SNAKE_BAR(state, content){
            state.snake = content
        },

        setApiUrl(state, content) {
            state.api[content.base][content.page] = content.url;
        },


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
        getApiContent(context, credentials){
            return new Promise((resolve, reject) => {
                axios.get(credentials.url, {
                    params: credentials.params
                }).then(response => {
                    const content = response.data
                    context.commit('SET_API_LOADED_DATA', content)
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
