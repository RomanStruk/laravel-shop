import axios from "axios";

const moduleSearchApi = {
    namespaced: true,
    state: () => ({
        products:'http://shop.test/api/v1/search/products',
        users:'http://shop.test/api/v1/search/users',
        filterGroups:'http://shop.test/api/v1/admin/filter-group',
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
export default moduleSearchApi;
