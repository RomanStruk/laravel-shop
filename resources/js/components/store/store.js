import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('access_token') || null,
        user: null
        // basket_list: localStorage.getItem('basket_list')
    },
    mutations: {
        retrieveUser(state, user) {
            state.user = user
        },
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
                axios.post('/api/v1/login', {
                    email: credentials.email,
                    password: credentials.password,
                }).then(response => {
                    const token = response.data.access_token
                    localStorage.setItem('access_token', token)
                    context.commit('retrieveToken', token)
                    resolve(response)
                }).catch(error => {
                    console.log(error)
                    reject(error)
                })
            })
        },
        retrieveTodos(context) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token

            axios.get('/')
                .then(response => {
                    context.commit('retrieveTodos', response.data)
                })
                .catch(error => {
                    console.log(error)
                })
        },
    }
})
