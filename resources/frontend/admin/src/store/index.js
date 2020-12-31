import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import moduleSearchApi from './modules/searchApiModule';
import productApiModule from "./modules/productApiModule";
import mediaApiModule from "./modules/mediaApiModule";
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        token: localStorage.getItem('access_token') || null,

        api: {
            order: {
                index: '/api/v1/admin/order',
                show: null,
                destroy: null
            },
            category: {
                index: '/api/v1/admin/category',
                show: null,
                destroy: null
            },
            product: {
                index: '/api/v1/admin/product',
                create: '/api/v1/admin/product',
                show: null,
                destroy: null
            },
            user: {
                index: '/api/v1/admin/user',
                show: null,
                destroy: null
            },
            media: {
                index: '/api/v1/admin/media',
                show: null,
                destroy: null
            },
            filter: {
                index: '/api/v1/admin/filter-group',
                show: null,
                destroy: null
            },
            supplier: {
                index: '/api/v1/admin/supplier',
                show: null,
                destroy: null
            },
            syllable: {
                index: '/api/v1/admin/syllable',
                show: null,
                destroy: null
            }
        },

        // api loaded storage
        apiLoadedData: {},

        snack: {
            status: false,
            text: '',
            color: ''
        }
    },
    mutations: {
        SET_API_LOADED_DATA(state, content) {
            state.apiLoadedData = content;
        },
        SNACK_BAR(state, content) {
            state.snack = content
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
        hasErrors(state) {
            return state.errors;
        }
    },
    actions: {
        apiDestroy(context, url){
            return new Promise((resolve, reject) => {
                axios.post(url, {'_method': 'delete'})
                    .then(response => {
                        const content = response.data
                        if (content.success === true){
                            context.commit('SNACK_BAR', {status: true, text: content.message, color: 'success'})
                            resolve(content)
                        }else {
                            context.commit('SNACK_BAR', {status: true, text: content.message, color: 'error'})
                        }
                    })
                    .catch(error => {
                        const content = error.response.data
                        context.commit('SNACK_BAR', {status: true, text: content.message, color: 'error'})
                        reject(content)
                    })
            })
        },
        apiCreate(context, credentials) {
            return new Promise((resolve, reject) => {
                axios.post(credentials.url, credentials.params)
                    .then(response => {
                        const content = response.data
                        context.commit('SNACK_BAR', {status: true, text: content.message, color: 'success'})
                        resolve(content)
                    })
                    .catch(error => {
                        const content = error.response.data
                        let errors = Object.values(error.response.data.errors).flat();
                        let text = '';
                        for (let m of errors){
                            text += m + ' ';
                        }
                        context.commit('SNACK_BAR', {status: true, text: text, color: 'error'})
                        reject(content)
                    })
            })
        },
        apiUpdate(context, credentials) {
            return new Promise((resolve, reject) => {
                let data = credentials.params
                // console.log(data)
                data["_method"] = 'patch';
                axios.post(credentials.url, data)
                    .then(response => {
                        const content = response.data
                        context.commit('SNACK_BAR', {status: true, text: content.message, color: 'success'})
                        resolve(content)
                    })
                    .catch(error => {
                        const content = error.response.data
                        context.commit('SNACK_BAR', {status: true, text: content.message, color: 'error'})
                        reject(content)
                    })
            })
        },
        getApiContent(context, credentials) {
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
                axios.post('/api/v1/login', {
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
    modules: {
        searchApi: moduleSearchApi,
        productApi: productApiModule,
        mediaApi: mediaApiModule
    }
})
