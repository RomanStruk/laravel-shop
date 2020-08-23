<template>
    <div>
        <v-dialog v-model="editDialog" max-width="1000px">
            <v-card>
                <v-toolbar flat color="primary" dark>
                    <v-toolbar-title>Редагувати</v-toolbar-title>
                    <v-spacer></v-spacer>

                    <v-btn icon>
                        <v-icon>mdi-content-save</v-icon>
                    </v-btn>
                    <v-btn icon @click="editDialog = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>

                </v-toolbar>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="6">
                                <v-text-field
                                    label="Назва"
                                    :value="editData.name"
                                ></v-text-field>
                                <v-text-field
                                    label="Ключові слова"
                                    :value="editData.keywords"
                                    :rules="[v => !!v || 'Item is required']"
                                ></v-text-field>
                                <v-text-field
                                    label="Опис"
                                    :value="editData.description"
                                    :rules="[v => !!v || 'Item is required']"
                                ></v-text-field>
                                <v-autocomplete
                                    label="Прикріпити до товару"
                                    item-text="title"
                                    item-value="product_id"
                                ></v-autocomplete>
                                <v-select
                                    label="Видимість"
                                    :items="['Видимий', 'Скритий']"
                                ></v-select>
                            </v-col>
                            <v-col cols="6">

                                <v-img
                                    :src="editData.url"
                                    :lazy-src="editData.url"
                                    aspect-ratio="1"
                                    class="grey lighten-2"
                                >
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
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-data-table
            :headers="headers"
            :items="items"
            :options.sync="options"
            :loading="loading"
            loading-text="Loading... Please wait"
            class="elevation-1"
            :server-items-length="totalItems"
        >

            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Зображення</v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="1000px">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="primary"
                                dark
                                v-bind="attrs"
                                v-on="on"
                                icon
                            >
                                <v-icon>mdi-plus-circle</v-icon>
                            </v-btn>
                        </template>
                        <v-card>

                            <v-toolbar flat color="primary" dark>
                                <v-toolbar-title>Додати</v-toolbar-title>
                                <v-spacer></v-spacer>

                                <v-btn icon>
                                    <v-icon>mdi-content-save</v-icon>
                                </v-btn>
                                <v-btn icon @click="dialog = false">
                                    <v-icon>mdi-close</v-icon>
                                </v-btn>

                            </v-toolbar>
                            <v-card-text>
                                <UploadImages :bindToProduct="true" :media-files="[]"></UploadImages>
                            </v-card-text>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>

            <template v-slot:item.img="props">
                <v-menu
                    ref="menu"
                    :close-on-content-click="false"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-card height="64"
                                width="90"
                        >
                            <v-img
                                :src="props.item.url"
                                height="64"
                                width="90"
                                class="grey darken-4"
                                v-bind="attrs"
                                v-on="on"
                            ></v-img>
                        </v-card>

                    </template>
                    <v-img
                        :src="props.item.url"
                        class="grey darken-4"
                    ></v-img>
                </v-menu>

            </template>


            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    color="teal lighten-2"
                    @click="editItem(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    color="red"
                    @click="action(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
        </v-data-table>

        <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
            {{ snackText }}

            <template v-slot:action="{ attrs }">
                <v-btn v-bind="attrs" text @click="snack = false">Close</v-btn>
            </template>
        </v-snackbar>
    </div>
</template>

<script>
    import UploadImages from "./UploadImages";
    export default {
        name: "Index",
        components: {UploadImages},
        data () {
            return {
                loading: false,
                dialog: false,
                snack: false,
                snackColor: '',
                snackText: '',
                max25chars: v => v.length <= 25 || 'Input too long!',
                pagination: {},
                headers: [
                    {
                        text: '#',
                        align: 'start',
                        sortable: false,
                        value: 'media_id',
                    },
                    { text: 'Зображення', value: 'img', sortable: false, },
                    { text: 'Ім\'я', value: 'name' },
                    { text: 'Ключові слова', value: 'keywords' },
                    { text: 'Опис', value: 'description' },
                    { text: 'Розмір (Kb)', value: 'size' },
                    { text: 'Розширення', value: 'extension' },
                    { text: 'Видимість', value: 'visibility' },
                    { text: 'Action', value: 'actions' },
                ],
                totalItems: 0,
                items: [],
                options: {},

                editDialog: false,
                editData: {}
            }
        },
        watch: {
            options: {
                handler() {
                    this.getDataFromApi().then(data => {
                        this.items = data.items
                        this.totalItems = data.total
                    })
                },
                deep: true,
            },
        },
        methods: {
            editItem(item){
                console.log(item)
                // TODO Запит на БД для отримання детальної інформації (method media/show)
                this.editData = item;
                this.editDialog = true
            },
            getDataFromApi() {
                this.loading = true
                return new Promise((resolve) => {
                    const {sortBy, sortDesc, page, itemsPerPage} = this.options
                    let credentials = {
                        url: this.$store.state.api.media.index,
                        params: {
                            page: page,
                            limit: itemsPerPage,
                            sortBy: sortBy,
                            sortDesc: sortDesc
                        }
                    }
                    this.$store.dispatch('getApiContent', credentials)
                        .then(() => {
                            let items = this.$store.state.apiLoadedData.data
                            let total = this.$store.state.apiLoadedData.meta.total;
                            resolve({
                                items,
                                total
                            })
                        })
                        .finally(() => {
                            this.loading = false
                        })

                })
            },

            action () {

            },

            save () {
                this.snack = true
                this.snackColor = 'success'
                this.snackText = 'Data saved'
            },
            cancel () {
                this.snack = true
                this.snackColor = 'error'
                this.snackText = 'Canceled'
            },
            open () {
                this.snack = true
                this.snackColor = 'info'
                this.snackText = 'Dialog opened'
            },
            close () {
                console.log('Dialog closed')
            },
        },
    }
</script>

<style scoped>

</style>
