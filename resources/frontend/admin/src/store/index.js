import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        token: localStorage.getItem('access_token') || null,
    },
    mutations: {
        retrieveToken(state, token) {
            state.token = token
        },
        destroyToken(state) {
            state.token = null
        },
    },
    getters: {
        loggedIn(state) {
            return state.token !== null
        },
    },
    actions: {
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
