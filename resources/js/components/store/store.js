import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('access_token') || null,
        user: null,
        shoppingCart:  JSON.parse(localStorage.getItem('shoppingCart')) || []        //магазинний візок
    },
    // commit
    mutations: {
        // add new product in a Shopping Cart
        putInShoppingCart(state, product){
            if (state.shoppingCart.length > 0){
                // якщо є товар в списку то додаємо до загальної кількості
                state.shoppingCart.forEach(function(item, i, arr) {
                    if (item.id === product.id){
                        arr[i].count += product.count;
                    }
                });
                // якщо нема то додаємо до кошику
                if(state.shoppingCart.every(function(item){if (item.id !== product.id){return true}})){
                    state.shoppingCart.push(product)
                }
            }else {
                state.shoppingCart.push(product)
            }
            localStorage.setItem('shoppingCart', JSON.stringify(state.shoppingCart))
        },
        // delete a product from a Shopping Cart
        pickUpFromShoppingCart(state, id){
            if (state.shoppingCart.length > 0){
                state.shoppingCart.forEach(function(item, i, arr) {
                    if (item.id === id){
                        arr.splice(i, 1);
                    }
                });
            }
            localStorage.setItem('shoppingCart', JSON.stringify(state.shoppingCart))
        },
        // destroy a Shopping Cart
        destroyShoppingCart(state){
            state.shoppingCart = [];
            localStorage.setItem('shoppingCart', JSON.stringify(state.shoppingCart))
        },

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
        shoppingCart(state){
            return state.shoppingCart
        },
        shoppingCartSumPrice(state){
            let sum = 0;
            if (state.shoppingCart.length > 0){
                state.shoppingCart.forEach(function(item, i, arr) {
                    sum += item.count*item.price;
                });
            }
            return sum;
        }
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
