import axios from "axios";

const mediaApiModule = {
    namespaced: true,
    state: () => ({
        api:'http://shop.test/api/v1/admin/media',
        mediaFiles: null,
        fileProgress: 0,
    }),
    mutations: {
        SET_API_LOADED_PRODUCTS(state, content) {
            state.products = content;
        },
        SET_FILE_PROGRESS(state, content) {
            state.fileProgress = content;
        },
    },
    actions: {
        async mediaStore(context, file) {
            return await new Promise((resolve, reject) => {
                let form = new FormData();
                form.append('media_file', file);
                axios.post(context.state.api, form, {
                    onUploadProgress: progressEvent => {
                        let fileProgress = Math.round((progressEvent.loaded / progressEvent.total) * 100);
                        context.commit('SET_FILE_PROGRESS', fileProgress)
                    }
                })
                    .then(response => {
                        if (response.data.success === true){
                            context.commit('SNACK_BAR', {status: true, text: response.data.message, color: 'success'}, {root:true})
                            resolve(response.data) // повернення даних
                        }else {
                            // error
                            context.commit('SNACK_BAR', {status: true, text: response.data.message, color: 'warning'}, {root:true})
                        }
                    })
                    .catch(error => {
                        //server error
                        context.commit('SNACK_BAR', {status: true, text: error.response.data.message, color: 'error'}, {root:true})
                        reject(error)
                    })
            })
        },
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
export default mediaApiModule;
