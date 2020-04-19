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
                        <td class="text-left col-3">Зображення</td>
                        <td class="text-left col-5">Назва</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="file in filesFinish">
                        <td class="text-right">
                            <input type="checkbox" name="media[]" :value="file.id" checked>
                        </td>
                        <td class="text-left">
                            <img :src="file.url" :alt="file.name" class="card-img-top" style="height: 60px; width: auto">
                        </td>
                        <td class="text-left text-break">{{ file.url }}</td>
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
            loadOldImages(){
                for (let file of old_media){
                    axios.get('/api/v1/media/detail/'+ file)
                        .then(response => {
                            this.filesFinish.push(response.data);
                        })
                        .catch(error => {
                            console.log(error);
                            toastr.error(error);
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
                    toastr.error('Помилка завантаження <br>'+item.name+'<br>'+error);
                    this.filesOrder.splice(item, 1);
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>

</style>