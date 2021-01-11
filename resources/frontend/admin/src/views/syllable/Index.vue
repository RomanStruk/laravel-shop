<template>
    <div>

        <v-dialog v-model="showItemDetails" max-width="500px">
            <v-card>
                <v-card-title>
                    <span class="headline">Перегляд</span>
                </v-card-title>

                <v-card-text>
                    <v-list two-line subheader>

                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Casio MRP-700-1 AVEFKXF - Касио МРП 700</v-list-item-title>
                                <v-list-item-subtitle>Товар</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>1000</v-list-item-title>
                                <v-list-item-subtitle>Ціна (грн.)</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>empty</v-list-item-title>
                                <v-list-item-subtitle>Опис</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>
                                    Кількість товарів
                                    <SyllableChart :height="120" :datasets="dataForChart"></SyllableChart>
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>
                                    <v-expansion-panels accordion>
                                        <v-expansion-panel>
                                            <v-expansion-panel-header class="pa-0">Список замовлень (21)
                                            </v-expansion-panel-header>
                                            <v-expansion-panel-content>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                                commodo consequat.
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
                    <v-btn color="blue darken-1" text @click="showItemDetails = false">ok</v-btn>
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
                    <v-toolbar-title>Склад товарів</v-toolbar-title>
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
                                <v-form
                                    ref="form"
                                    v-model="valid"
                                    lazy-validation
                                >
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12">
                                                <v-autocomplete label="Постачальник*"></v-autocomplete>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-autocomplete label="Товар*"></v-autocomplete>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-text-field
                                                    label="Кількість товару*"
                                                    hint="одиниць товару(шт)"
                                                ></v-text-field>

                                            </v-col>
                                            <v-col cols="12">
                                                <v-text-field
                                                    label="Ціна товару*"
                                                    hint="за одну шт"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-textarea label="Опис"></v-textarea>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-form>
                                <small>*indicates required field</small>
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
            <template v-slot:item.product.title="{item}">
                <router-link :to="'/product/show?product='+item.product.links.self">{{item.product.title}}</router-link>
                <br>
                <small>
                    Created {{ item.created_at }}
                </small>
            </template>
            <template v-slot:item.iron="props">
                <v-edit-dialog
                    :return-value.sync="props.item.iron"
                    large
                    persistent
                    @save="save"
                    @cancel="cancel"
                    @open="open"
                    @close="close"
                >
                    <div>{{ props.item.iron }}</div>
                    <template v-slot:input>
                        <div class="mt-4 title">Update Iron</div>
                    </template>
                    <template v-slot:input>
                        <v-text-field
                            v-model="props.item.iron"
                            :rules="[max25chars]"
                            label="Edit"
                            single-line
                            counter
                            autofocus
                        ></v-text-field>
                    </template>
                </v-edit-dialog>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="showItemAction(item)"
                >mdi-eye
                </v-icon>
                <v-icon
                    small
                    class="mr-2"
                    @click="editItem(item)"
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

    </div>
</template>

<script>

    import SyllableChart from "../../components/charts/SyllableChart";

    export default {
        name: "Index",
        data() {
            return {
                valid: true,
                loading: false,
                dialog: false,
                showItemDetails: false,

                showChart: false,
                dataForChart: null,


                max25chars: v => v.length <= 25 || 'Input too long!',
                pagination: {},
                headers: [
                    {
                        text: '#',
                        align: 'start',
                        sortable: false,
                        value: 'syllable_id',
                    },
                    {text: 'Товар', value: 'product.title'},
                    {text: 'Постачатьник', value: 'supplier.name'},
                    {text: 'Додано (шт)', value: 'imported'},
                    {text: 'Залишилось (шт)', value: 'remains'},
                    {text: 'Обробляється (шт)', value: 'countProcessed'},
                    {text: 'Опис', value: 'description'},
                    {text: 'Action', value: 'actions'},
                ],
                totalItems: 0,
                items: [],
                options: {},

                // create/edit dialog
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
        components: {
            SyllableChart,
        },
        mounted() {

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
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'Нова поставка товару' : 'Редагувати поставку товару'
            },
        },
        methods: {
            // onClick Show Item
            showItemAction(item) {
                this.showItemDetails = true;
                this.dataForChart = {};
                (new Promise((resolve) => setTimeout(resolve, 300))).then(() => {
                    this.dataForChart = item;
                });
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
                        url: this.$store.state.api.syllable.index,
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

            },
            cancel() {

            },
            open() {

            },
            close() {
                console.log('Dialog closed')
            },
        },
    }
</script>

