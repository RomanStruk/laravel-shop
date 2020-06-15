<template>
    <div>
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
                    <v-toolbar-title>My CRUD</v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="primary"
                                dark
                                class="mb-2"
                                v-bind="attrs"
                                v-on="on"
                            >New Item
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="headline">Add Category</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field  label="#"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field  label="Замовник"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field  label="На суму"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field  label="Дата зміни"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field  label="Статус"></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="dialog = false">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="dialog = false">Save</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>

            <template v-slot:item.name="props">
                <v-edit-dialog
                    :return-value.sync="props.item.name"
                    @save="save"
                    @cancel="cancel"
                    @open="open"
                    @close="close"
                > {{ props.item.name }}
                    <template v-slot:input>
                        <v-text-field
                            v-model="props.item.name"
                            :rules="[max25chars]"
                            label="Edit"
                            single-line
                            counter
                        ></v-text-field>
                    </template>
                </v-edit-dialog>
            </template>
            <template v-slot:item.values="props">
                    <span v-for="attribute in props.item.values" :key="attribute.id">{{ attribute.value }}, </span>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="action(item)"
                >mdi-eye</v-icon>
                <v-icon
                    small
                    class="mr-2"
                    @click="action(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
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
    export default {
        name: "Index",
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
                        value: 'filter_id',
                    },
                    { text: 'Назва', value: 'name' },
                    { text: 'Варіанти', value: 'values' },
                    { text: 'Action', value: 'actions' },
                ],

                totalItems: 0,
                items: [],
                options: {},
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
            getDataFromApi() {
                this.loading = true
                return new Promise((resolve) => {
                    const {sortBy, sortDesc, page, itemsPerPage} = this.options
                    let credentials = {
                        url: this.$store.state.api.filter.index,
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
