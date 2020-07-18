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
                    <v-dialog v-model="dialog" max-width="1000px">
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
                                <span class="headline">Create/Edit</span>

                            </v-card-title>
                            <v-card-text>
                                <v-text-field
                                    label="Назва групи фільтрів"
                                ></v-text-field>
                                <v-list>
                                    <v-list-item v-for="item in values" :key="item.value">
                                        <v-text-field
                                            v-if="editing === item"
                                            v-model="editing.value"
                                            autofocus
                                            flat
                                            background-color="transparent"
                                            hide-details
                                            solo
                                            @keyup.enter="edit(index, item)"
                                        ></v-text-field>
                                        <v-chip
                                            v-else
                                            :color="`${item.color} lighten-3`"
                                            dark
                                            label
                                            small
                                        >
                                            {{ item.value }}
                                        </v-chip>
                                        <v-spacer></v-spacer>
                                        <v-list-item-action @click.stop>
                                            <v-btn
                                                icon
                                                @click.stop.prevent="edit(index, item)"
                                            >
                                                <v-icon>{{ editing !== item ? 'mdi-pencil' : 'mdi-check' }}</v-icon>
                                            </v-btn>
                                        </v-list-item-action>
                                        <v-list-item-action @click.stop>
                                            <v-btn
                                                icon
                                                @click.stop.prevent="destroy(index)"
                                            >
                                                <v-icon>mdi-trash-can</v-icon>
                                            </v-btn>
                                        </v-list-item-action>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-text-field
                                            flat
                                            background-color="transparent"
                                            hide-details
                                            label="Варіант"
                                        ></v-text-field>
                                        <v-list-item-action @click.stop>
                                            <v-btn
                                                icon
                                                @click.stop.prevent="add()"
                                            >
                                                <v-icon>mdi-plus-box</v-icon>
                                            </v-btn>
                                        </v-list-item-action>
                                    </v-list-item>
                                </v-list>
                            </v-card-text>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
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
                    @click="editAction(item)"
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
                items:[],

                totalItems: 0,
                options: {},

                // editing
                activator: null,
                colors: ['green', 'purple', 'indigo', 'cyan', 'teal', 'orange'],
                editing: null,
                index: -1,
                values: [
                    {
                        text: 'Foo',
                        color: 'blue',
                    },
                    {
                        text: 'Bar',
                        color: 'red',
                    },
                ],
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
            //editing

            editAction (item) {
                console.log(item)
                this.values = item.values;
                this.dialog = true

            },
            edit(index, item) {
                if (!this.editing) {
                    this.editing = item
                    this.index = index
                } else {
                    this.editing = null
                    this.index = -1
                }
            },
            add(){
            },
            destroy(index){
                this.values.splice(index, 1)
            },
            //end editing

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
