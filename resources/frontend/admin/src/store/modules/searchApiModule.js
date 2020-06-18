import axios from "axios";

const moduleSearchApi = {
    namespaced: true,
    state: () => ({
        products:'http://shop.test/api/v1/search/products',
        users:'http://shop.test/api/v1/search/users'
    }),
    mutations: {

    },
    actions: {
        getSearch(context, credentials) {
            return new Promise((resolve, reject) => {
                axios.get(credentials.focus, {
                    params: credentials.params
                }).then(response => {
                    resolve(response.data)
                }).catch(error => {
                    reject(error)
                })
            })
        },
    },
    getters: {

    }
}
export default moduleSearchApi;
