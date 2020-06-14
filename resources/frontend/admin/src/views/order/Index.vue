<template>
    <div>

        <v-data-table
            :headers="headers"
            :items="orders"
            sort-by="calories"
            class="elevation-1"
            :loading="loading"
            loading-text="Loading... Please wait"
            hide-default-footer
            :options="{itemsPerPage: 15}"
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
                                <span class="headline">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.name" label="#"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.calories" label="Замовник"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.fat" label="На суму"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.carbs" label="Дата зміни"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.protein" label="Статус"></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.user="{item}">
                {{item.user.full_name}}
                <br>
                <small>
                    Created {{ item.created_at }}
                </small>
            </template>
            <template v-slot:item.status_description="{ item }">
                <v-chip small outlined v-if="item.status===1" color="warning" dark>{{ item.status_description }}</v-chip>
                <v-chip small outlined v-if="item.status===2 || item.status===3" color="success" dark>{{ item.status_description }}</v-chip>
                <v-chip small outlined v-if="item.status > 3" color="red" dark>{{ item.status_description }}</v-chip>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="showItem(item)"
                >mdi-eye</v-icon>
                <v-icon
                    small
                    class="mr-2"
                    @click="$store.commit('createSuccessMessage', 'Some error message creating')"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    @click="deleteItem(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
            <template v-slot:no-data>
                <v-btn color="primary" @click="initialize">Reset</v-btn>
            </template>
        </v-data-table>
        <Pagination state="ordersLoadedData" commit="setOrdersCurrentPage" getList="getOrders" @loading="onLoading"></Pagination>
    </div>
</template>

<script>
    import Pagination from "../../components/Pagination";
    export default {
        name: "Index",
        components: {Pagination},
        data: () => ({
            loading: false,
            dialog: false,
            headers: [
                {
                    text: '#',
                    align: 'start',
                    sortable: false,
                    value: 'order_id',
                },
                {text: 'Замовник', value: 'user', sortable: false},
                {text: 'На суму', value: 'sum_price'},
                {text: 'Змінено', value: 'updated_at'},
                {text: 'Статус', value: 'status_description'},
                {text: 'Дія', value: 'actions', sortable: false},
            ],
            desserts: [],
            // orders: [],

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
        }),

        computed: {
            orders:{
                get(){
                    return this.$store.state.ordersLoadedData.data;
                }
            },

            formTitle() {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            },
        },

        watch: {
            dialog(val) {
                val || this.close()
            },
        },

        created() {
            this.initialize()
        },

        methods: {
            onLoading(val){
                this.loading = val
            },

            initialize() {
                this.loading = true
                this.$store.dispatch('getOrders', {page:1}).finally(()=>{
                    this.loading = false
                });
            },
            showItem(item){
                console.log(item)
                this.$router.push({ path: '/order/show', query: {order:item.links.self} })
            },
            editItem(item) {
                this.editedIndex = this.desserts.indexOf(item)
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
