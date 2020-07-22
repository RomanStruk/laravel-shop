import axios from "axios";

const productApiModule = {
    namespaced: true,
    state: () => ({
        api:'http://shop.test/api/v1/admin/product',
        products: null
    }),
    mutations: {
        SET_API_LOADED_PRODUCTS(state, content) {
            state.products = content;
        },
    },
    actions: {
        getProducts(context, credentials) {
            return new Promise((resolve, reject) => {
                axios.get(context.state.api, {
                    params: credentials.params
                }).then(response => {
                    context.commit('SET_API_LOADED_PRODUCTS', response.data)
                    resolve(response.data)
                }).catch(error => {
                    reject(error)
                })
            })
        },
        getProduct(context, productLinkForApi) {
            return new Promise((resolve, reject) => {
                axios.get(productLinkForApi).then(response => {
                    resolve(response.data)
                }).catch(error => {
                    const content = error.response.data
                    context.commit('SNACK_BAR', {status: true, text: content.message, color: 'error'}, {root:true})
                    reject(error)
                })
            })
        },
    },
    getters: {
        getProducts(state) {
            return state.products;
        },
    }
}
export default productApiModule;
