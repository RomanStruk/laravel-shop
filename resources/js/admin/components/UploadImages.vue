<template>
    <div>
        <div class="progress">
            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" :style="{width: fileProgress+'%'}">
                <span class="sr-only">{{fileCurrent}}</span>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" name="media_file" class="custom-file-input" id="inputGroupFile01" multiple  @change="fileInputChange">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>
        <div class="row">
            <div class="col-12" v-if="filesOrder.length > 0">
                <h5 class="text-center">Файли в черзі {{filesOrder.length}}</h5>
                <ul class="list-group">
                    <li class="list-group-item" v-for="file in filesOrder">
                        {{file.name}} : {{file.type}}
                    </li>
                </ul>
            </div>
            <div class="col-12" v-if="filesFinish.length > 0">
                <h5 class="text-center">Файли завантажені {{filesFinish.length}}</h5>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td class="text-right col-1">
                            <input type="checkbox"
                                   onclick="$('input[name*=\'files\']').prop('checked', this.checked);">
                        </td>
                        <td class="text-left col-4">Зображення</td>
                        <td class="text-left col-6">URL</td>
                        <td class="text-left col-1">Дія</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(file, index) in filesFinish">
                        <td class="text-right">
                            <input type="checkbox" name="media[]" :value="file.id" checked>
                        </td>
                        <td class="text-left">
                            <img :src="file.url" :alt="file.name" class="card-img-top" style="height: 60px; width: auto">
                        </td>
                        <td class="text-left text-break">{{ file.url }}</td>
                        <td class="text-right">
                            <button class="btn btn-danger btn-sm" v-on:click.prevent="deleteFile(file.id)" title="Delete"><i class="fa fa-trash"></i></button>
                            <button class="btn btn-info btn-sm" v-on:click.prevent="moveUp(filesFinish, index, index-1)" title="Move Up"><i class="fa fa-arrow-up"></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UploadImages",
        data(){
            return {
                filesOrder:[],
                filesFinish: [],
                fileProgress: 0,
                fileCurrent: '',
            }
        },
        mounted() {
            this.loadOldImages();
        },
        methods:{
            moveUp(arr, old_index, new_index){
                if (new_index >= arr.length) {
                    var k = new_index - arr.length + 1;
                    while (k--) {
                        arr.push(undefined);
                    }
                }
                arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
                return arr; // for testing
            },
            deleteFile(file){
                if(confirm("Do you really want to delete?")) {
                    axios.delete('/api/v1/media/destroy/' + file)
                        .then(response => {
                            let files = this.filesFinish;
                            let newFinish = [];
                            for (let item of files) {
                                if (item.id != file) {
                                    newFinish.push(item);
                                }
                            }
                            this.filesFinish = newFinish;
                            // this.filesFinish.splice(file, 1);
                            console.log(this.filesFinish);
                            toastr.success(response.data.message);
                        })
                        .catch(error => {
                            if (error.response) {
                                toastr.error(error.response.data.message);
                            } else{
                                console.log('Error', error.message);
                                toastr.error(error);
                            }
                        });
                }
            },
            async loadOldImages(){
                for (let file of old_media){
                    await axios.get('/api/v1/media/detail/'+ file)
                        .then(response => {
                            this.filesFinish.push(response.data);
                        })
                        .catch(error => {
                            if (error.response) {
                                toastr.error('Помилка завантаження <br>'+error.response.data.message);
                            } else{
                                console.log('Error', error.message);
                                toastr.error('Помилка завантаження <br>'+error);
                            }
                        });
                }
            },
            async fileInputChange(){
                let files = Array.from(event.target.files);
                this.filesOrder = files.slice();
                for (let item of files){
                    await this.uploadFile(item);
                }
            },

            async uploadFile(item){
                let form = new FormData();
                form.append('media_file', item);
                await axios.post('/api/v1/media/store', form, {
                    onUploadProgress: progressEvent => {
                        this.fileProgress = Math.round((progressEvent.loaded / progressEvent.total) * 100);
                        this.fileCurrent = item.name + ' ' + this.fileProgress + '%';
                    }
                })
                .then(response => {
                    this.fileProgress = 0;
                    this.fileCurrent = '';
                    this.filesFinish.push(response.data);
                    // console.log(response);
                    this.filesOrder.splice(item, 1);
                    toastr.success('Файл успішно завантажений<br>'+item.name)
                })
                .catch(error => {
                    if (error.response) {
                        toastr.error('Помилка завантаження <br>'+item.name+'<br>'+error.response.data.message);
                    } else{
                        console.log('Error', error.message);
                        toastr.error('Помилка завантаження <br>'+item.name+'<br>'+error);
                    }
                    this.filesOrder.splice(item, 1);
                })
            }
        }
    }
</script>

<style scoped>

</style>