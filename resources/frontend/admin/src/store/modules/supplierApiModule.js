import axios from "axios";

const supplierApiModule = {
    namespaced: true,
    state: () => ({
        api:'http://shop.test/api/v1/admin/supplier',
        mediaFiles: null,
        fileProgress: 0,
    }),
    mutations: {
        SET_API_LOADED_PRODUCTS(state, content) {
            state.products = content;
        },

    },
    actions: {

        getMediaFiles(context, credentials) {
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
        getMediaFile(context, productLinkForApi) {
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

    }
}
export default supplierApiModule;
