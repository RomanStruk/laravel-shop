<template>
    <v-container>
        <v-row>
            <v-col cols="6">
                <v-subheader v-if="!editing">Виберіть файл для редагування</v-subheader>
                <v-subheader v-if="editing">Редагується файл #{{editFile.media_id}}</v-subheader>
                <v-text-field
                    label="Назва"
                    :disabled="!editing"
                    :value="editFile.name"
                ></v-text-field>
                <v-text-field
                    label="Ключові слова"
                    :rules="[v => !!v || 'Item is required']"
                    :disabled="!editing"
                    :value="editFile.keywords"
                ></v-text-field>
                <v-text-field
                    label="Опис"
                    :rules="[v => !!v || 'Item is required']"
                    :value="editFile.description"
                    :disabled="!editing"
                ></v-text-field>
                <v-select
                    v-if="bindToProduct"
                    label="Прикріпити до товару"
                    item-text="title"
                    item-value="product_id"
                    :disabled="!editing"
                ></v-select>
                <v-select
                    v-if="bindToProduct"
                    label="Видимість"
                    :disabled="!editing"
                    :value="editFile.visibility"
                ></v-select>
                <v-btn :disabled="!editing" color="primary" @click="updateMedia(editFile)">Оновити</v-btn>
            </v-col>
            <v-col cols="6">
                <v-file-input
                    accept="image/png, image/jpeg, image/bmp"
                    placeholder="Виберіть зображення"
                    prepend-icon="mdi-camera"
                    label="Зображення"
                    multiple
                    @change="fileInputChange"
                ></v-file-input>
                <v-progress-linear
                    v-if="countFilesOrder > 0"
                    :value="downloadedProgress"
                    height="25"
                    stream
                >
                    <strong>{{ Math.ceil(downloadedProgress) }}% ({{filesDownloaded}}/{{countFilesOrder}})</strong>
                </v-progress-linear>
                <v-row>
                    <v-col
                        v-for="(file, index) in filesFinish"
                        :key="file.media_id"
                        class="d-flex child-flex"
                        cols="4"
                    >
                        <v-hover v-slot:default="{ hover }">
                            <v-card flat tile class="d-flex" :elevation="hover ? 12 : 2">
                                <v-img
                                    :src="file.url"
                                    :lazy-src="file.url"
                                    aspect-ratio="1"
                                    class="grey lighten-2"
                                    :style="hover ? '': 'opacity: 0.7;'"
                                >
                                    <v-card-title class="title white--text">
                                        <v-row
                                            class="fill-height flex-column"
                                            justify="space-between"
                                            :style="hover ? 'background-color: rgba(0, 0, 255, 0.2);':''"
                                        >

                                            <div class="align-self-center">
                                                <v-btn
                                                    :color="hover ? 'yellow' : 'transparent'"
                                                    icon
                                                    v-on:click.prevent="moveUp(index, index-1)"
                                                >
                                                    <v-icon>mdi-arrow-up-bold</v-icon>
                                                </v-btn>
                                                <v-btn
                                                    :color="hover ? 'teal lighten-2' : 'transparent'"
                                                    icon
                                                    @click="chooseMediaForEdit(file)"
                                                >
                                                    <v-icon>mdi-pencil</v-icon>
                                                </v-btn>
                                                <v-btn
                                                    :color="hover ? 'red' : 'transparent'"
                                                    icon
                                                    @click="destroyMedia(file)"
                                                >
                                                    <v-icon>mdi-delete</v-icon>
                                                </v-btn>
                                                <v-btn
                                                    :color="hover ? 'yellow' : 'transparent'"
                                                       icon
                                                       v-on:click.prevent="moveUp(index, index+1)"
                                                >
                                                    <v-icon>mdi-arrow-down-bold</v-icon>
                                                </v-btn>
                                            </div>
                                        </v-row>
                                    </v-card-title>

                                    <template v-slot:placeholder>
                                        <v-row
                                            class="fill-height ma-0"
                                            align="center"
                                            justify="center"
                                        >
                                            <v-progress-circular indeterminate
                                                                 color="grey lighten-5"></v-progress-circular>
                                        </v-row>
                                    </template>
                                </v-img>
                            </v-card>
                        </v-hover>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    export default {
        name: "UploadImages",
        data: function () {
            return {
                valid: true,
                isLoading: false,
                editing: false,
                editFile: {},

                file_rules: [
                    value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
                ],

                transparent: 'rgba(255, 255, 255, 0)',

                filesFinish: this.mediaFiles,
                filesOrder: [],
                filesDownloaded: 0,
                countFilesOrder: 0,
            }
        },
        props: ['bindToProduct', 'mediaFiles'],
        methods: {
            async fileInputChange() {
                let files = Array.from(event.target.files);
                this.filesOrder = files.slice();
                this.countFilesOrder = this.filesOrder.length;                          // кількість файлів в черзі
                this.filesDownloaded = 0                                                // кількіть завантажених файлів
                for (let item of files) {
                    await this.$store.dispatch('mediaApi/mediaStore', item)
                        .then(response => {
                            this.fileCurrent = '';                                      // обнуляємо імя поточного файла
                            this.filesFinish.push(response.data);                       // додаємо відповідь в файли завантажень
                            this.filesOrder.splice(item, 1);                            // видаляємо файл з черги
                            this.filesDownloaded++;                                     // лічильник завант. файлів +1
                            console.log('Файл успішно завантажений' + item.name)
                        })
                        .catch(error => {
                            console.log(error)
                            this.filesOrder.splice(item, 1);
                        })
                }
            },
            moveUp(old_index, new_index){
                let arr = this.filesFinish;
                if (new_index >= arr.length) {
                    let k = new_index - arr.length + 1;
                    while (k--) {
                        arr.push(undefined);
                    }
                }
                arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
                return this.filesFinish = arr; // for testing
            },
            chooseMediaForEdit(file){
                this.editing = true;
                this.editFile = file;
            },
            updateMedia(file){
                console.log(file);
            },
            destroyMedia(item){
                if (confirm('Are you sure you want to delete this item?')) {
                    this.$store.dispatch('apiDestroy', item.links.destroy)
                        .then(() => {
                            let index = this.filesFinish.indexOf(item)
                            this.filesFinish.splice(index, 1)
                        })
                }
            }
        },
        computed: {
            downloadedProgress() {
                return this.$store.state.mediaApi.fileProgress                          // прогрес завантаження в відсотках
            }
        }


    }
</script>

<style scoped>
    .show-btns {
        color: rgb(78, 155, 168) !important;
    }

    .show-delete-btn {
        color: rgb(236, 22, 22) !important;
    }
</style>
