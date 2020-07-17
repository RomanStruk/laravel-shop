<template>
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
                <v-toolbar-title>Список замовлень</v-toolbar-title>
                <v-divider
                    class="mx-4"
                    inset
                    vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-select label="Статус"></v-select>
                <v-menu
                    ref="menu"
                    v-model="calendar"
                    :close-on-content-click="false"
                    :return-value.sync="date"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="date"
                            label="Picker in menu"
                            prepend-icon="mdi-calendar"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker v-model="date" no-title scrollable>
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="calendar = false">Cancel</v-btn>
                        <v-btn text color="primary" @click="$refs.menu.save(date)">OK</v-btn>
                    </v-date-picker>
                </v-menu>
                <v-spacer></v-spacer>
                <CreateOrderDialog></CreateOrderDialog>
            </v-toolbar>
        </template>
        <template v-slot:item.user="{item}">
            <b>{{item.user.full_name}}</b>
            <br>
            <small>
                Створений {{ item.created_at }}
            </small>
        </template>
        <template v-slot:item.status_description="{ item }">
            <v-chip small outlined v-if="item.status===1" color="warning" dark>{{ item.status_description }}</v-chip>
            <v-chip small outlined v-if="item.status===2 || item.status===3" color="success" dark>
                {{item.status_description }}
            </v-chip>
            <v-chip small outlined v-if="item.status > 3" color="red" dark>{{ item.status_description }}</v-chip>
        </template>
        <template v-slot:item.actions="{ item }">
            <v-icon
                small
                class="mr-2"
                color="blue"
                @click="showItem(item)"
            >mdi-eye
            </v-icon>
            <v-icon
                small
                color="red"
                @click="deleteItem(item)"
            >
                mdi-delete
            </v-icon>
        </template>
        <template v-slot:no-data>
            <v-btn color="primary" @click="getDataFromApi">Reset</v-btn>
        </template>
    </v-data-table>
</template>

<script>
    import CreateOrderDialog from "./CreateOrderDialog";
    export default {
        name: "Index",
        components: {CreateOrderDialog},
        data: () => ({
            date: new Date().toISOString().substr(0, 10),
            calendar: false,

            loading: false,
            headers: [
                {
                    text: '#',
                    align: 'start',
                    sortable: false,
                    value: 'order_id',
                },
                {text: 'Замовник', value: 'user', sortable: false},
                {text: 'На суму', value: 'total_products_price'},
                {text: 'Змінено', value: 'updated_at'},
                {text: 'Статус', value: 'status_description'},
                {text: 'Дія', value: 'actions', sortable: false},
            ],

            editedIndex: -1,
            editedItem: {
                name: '',
                calories: 0,
                fat: 0,
                carbs: 0,
                protein: 0,
            },
            defaultItem: {
                name: '',
                calories: 0,
                fat: 0,
                carbs: 0,
                protein: 0,
            },

            totalItems: 0,
            items: [],
            options: {},
        }),

        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            },
        },

        watch: {

            dialog(val) {
                val || this.close()
            },
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
        created() {

        },
        methods: {
            getDataFromApi() {
                this.loading = true
                return new Promise((resolve) => {
                    const {sortBy, sortDesc, page, itemsPerPage} = this.options
                    let credentials = {
                        url: this.$store.state.api.order.index,
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
            showItem(item) {
                console.log(item)
                this.$router.push({path: '/order/show', query: {order: item.links.self}})
            },
            editItem(item) {
                this.editedIndex = this.items.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem(item) {
                const index = this.desserts.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
            },

            close() {
                this.dialog = false
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                })
            },

            save() {
                if (this.editedIndex > -1) {
                    Object.assign(this.desserts[this.editedIndex], this.editedItem)
                } else {
                    this.desserts.push(this.editedItem)
                }
                this.close()
            },
        },
    }
</script>

<style scoped>

</style>
