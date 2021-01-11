<template>
    <div>
        <v-dialog v-model="showItemDialog" max-width="800px">
            <v-card>
                <v-card-title>
                    <span class="headline">Перегляд</span>
                </v-card-title>

                <v-card-text>
                    <v-list  subheader >

                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Greenfelder, Brakus and Green</v-list-item-title>
                                <v-list-item-subtitle>Постачальник</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>description company description company description company
                                </v-list-item-title>
                                <v-list-item-subtitle>Опис</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>
                                    <v-expansion-panels accordion>
                                        <v-expansion-panel>
                                            <v-expansion-panel-header class="pa-0">Товари на складі (21)
                                            </v-expansion-panel-header>
                                            <v-expansion-panel-content>
                                                <v-list dense >
                                                    <v-list-item-group >
                                                        <v-list-item>
                                                            <v-list-item-content>
                                                                <v-list-item-title>Casio GA-1000-1 AER KXF - Касио ДЖА
                                                                    АЕ К
                                                                    <v-chip small color="primary" dark>1000</v-chip>
                                                                    <v-chip small color="teal" dark>820</v-chip>
                                                                    <v-chip small color="warning" dark>63</v-chip>
                                                                </v-list-item-title>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                        <v-list-item>
                                                            <v-list-item-content>
                                                                <v-list-item-title>Casio GA-1000-1 AER KXF - Касио ДЖА
                                                                    АЕ К
                                                                    <v-chip small color="primary" dark>1000</v-chip>
                                                                    <v-chip small color="teal" dark>820</v-chip>
                                                                    <v-chip small color="warning" dark>63</v-chip>
                                                                </v-list-item-title>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                        <v-list-item>
                                                            <v-list-item-content>
                                                                <v-list-item-title>Casio GA-1000-1 AER KXF - Касио ДЖА
                                                                    АЕ К
                                                                    <v-chip small color="primary" dark>1000</v-chip>
                                                                    <v-chip small color="teal" dark>820</v-chip>
                                                                    <v-chip small color="warning" dark>63</v-chip>
                                                                </v-list-item-title>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                    </v-list-item-group>
                                                </v-list>
                                                <v-chip small color="primary" dark>Поставка</v-chip>
                                                <v-chip small color="teal" dark>В наявсності</v-chip>
                                                <v-chip small color="warning" dark>Обробляється</v-chip>
                                            </v-expansion-panel-content>
                                        </v-expansion-panel>
                                    </v-expansion-panels>
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>

                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="showItemDialog = false">ok</v-btn>
                </v-card-actions>
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
                    <v-toolbar-title>Постачальники</v-toolbar-title>
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
                            >Додати
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="headline">{{formTitle}}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field
                                                label="Назва постачальника"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-textarea
                                                label="Опис"
                                            ></v-textarea>
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


            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="showItem(item)"
                    color="blue"
                >mdi-eye
                </v-icon>
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
    export default {
        name: "Index",
        data() {
            return {
                loading: false,
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
                        value: 'supplier_id',
                    },
                    {text: 'Назва', value: 'name'},
                    {text: 'Опис', value: 'description'},
                    {text: 'Action', value: 'actions'},
                ],
                totalItems: 0,
                items: [],
                options: {},

                // show dialog
                showItemDialog: false,
                showItemData: null,

                // create/edit dialog
                dialog: false,
                valid: true,
                editedIndex: -1,
                editedItem: {
                    name: '',
                    slug: '',
                    description: '',
                    parent_id: 0,
                },
                defaultItem: {
                    name: '',
                    slug: '',
                    description: '',
                    parent_id: 0,
                },
            }
        },
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'Новий постачальник' : 'Редагувати постачальника'
            },
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
            // onClick show Item
            showItem(item) {
                this.showItemData = item;
                this.showItemDialog = true;
            },
            // onClick edit Item
            editItem(item) {
                this.editedIndex = this.items.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },
            getDataFromApi() {
                this.loading = true
                return new Promise((resolve) => {
                    const {sortBy, sortDesc, page, itemsPerPage} = this.options
                    let credentials = {
                        url: this.$store.state.api.supplier.index,
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
            action() {

            },

            save() {
                this.snack = true
                this.snackColor = 'success'
                this.snackText = 'Data saved'
            },
            cancel() {
                this.snack = true
                this.snackColor = 'error'
                this.snackText = 'Canceled'
            },
            open() {
                this.snack = true
                this.snackColor = 'info'
                this.snackText = 'Dialog opened'
            },
            close() {
                console.log('Dialog closed')
            },
        },
    }
</script>

<style scoped>

</style>
