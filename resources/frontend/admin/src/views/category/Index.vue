<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="categories"
            :options.sync="options"
            :loading="loading"
            loading-text="Loading... Please wait"
            class="elevation-1"
            :server-items-length="totalCategories"
        >

            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Категорії</v-toolbar-title>
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
                        <v-form
                            ref="form"
                            v-model="valid"
                            lazy-validation
                        >
                            <v-card>
                                <v-card-title>
                                    <span class="headline">{{ formTitle }}</span>
                                </v-card-title>

                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field
                                                    v-model="editedItem.name"
                                                    label="Категорія"
                                                    :rules="categoryNameRules"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-text-field
                                                    v-model="editedItem.slug"
                                                    label="Слоган"
                                                    :rules="[v => !!v || 'Item is required']"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-select
                                                    :items="selectItems"
                                                    label="Батьківська категорія"
                                                    item-text="name"
                                                    item-value="category_id"
                                                    v-model="editedItem.parent_id"
                                                    :rules="parentRules"
                                                ></v-select>
                                            </v-col>
                                            <v-col>
                                                <v-textarea
                                                    v-model="editedItem.description"
                                                    :rules="[v => !!v || 'Item is required']"
                                                    label="Опис"
                                                    rows="3"
                                                ></v-textarea>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                                    <v-btn color="blue darken-1" text @click="save" :disabled="!valid">Save</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-form>
                    </v-dialog>
                </v-toolbar>
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
                    @click="destroyItem(item)"
                >mdi-delete
                </v-icon>
            </template>
        </v-data-table>

    </div>
</template>

<script>


    export default {
        name: "Index",
        data() {
            return {
                valid: true,

                parentRules: [
                    v => (v >= 0) || 'Помилка валідації',
                ],
                categoryNameRules: [
                    v => !!v || 'Item is required',
                    v => (v.length >= 4) || 'Мінімальна довжина 4 символи',
                ],

                loading: false,
                dialog: false,

                headers: [
                    {
                        text: '#',
                        align: 'start',
                        sortable: false,
                        value: 'category_id',
                    },
                    {text: 'Заголовок', value: 'name'},
                    {text: 'Slug', value: 'slug'},
                    {text: 'Опис', value: 'description'},
                    {text: 'Батьківський елемент', value: 'parent.name'},
                    {text: 'Action', value: 'actions'},
                ],


                totalCategories: 0,
                categories: [],
                options: {},

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
            selectItems() {
                let temp = [...this.categories];
                temp.push({name: 'No selected', category_id: 0})
                return temp;
            },
            formTitle() {
                return this.editedIndex === -1 ? 'Нова категорія' : 'Редагувати категорію'
            },
        },
        watch: {
            options: {
                handler() {
                    this.getDataFromApi()
                        .then(data => {
                            this.categories = data.items
                            this.totalCategories = data.total
                        })
                },
                deep: true,
            },
            dialog(val) {
                val || this.close()
            },
        },
        mounted() {

        },
        methods: {
            validate() {
                this.$refs.form.validate()
            },
            getDataFromApi() {
                this.loading = true
                return new Promise((resolve) => {
                    const {sortBy, sortDesc, page, itemsPerPage} = this.options
                    let credentials = {
                        url: this.$store.state.api.category.index,
                        params: {
                            page: page,
                            limit: itemsPerPage,
                            sortBy: sortBy,
                            sortDesc: sortDesc
                        }
                    }
                    this.$store.dispatch('getApiContent', credentials)
                        .then((response) => {
                            let content = response.data;
                            let items = content.data
                            let total = content.meta.total;
                            console.log(items)
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
            destroyItem(item) {
                if (confirm('Are you sure you want to delete this item?')) {
                    this.$store.dispatch('apiDestroy', item.links.destroy)
                        .then(() => {
                            let index = this.categories.indexOf(item)
                            this.categories.splice(index, 1)
                        })
                }
            },
            editItem(item) {
                this.editedIndex = this.categories.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            close() {
                this.dialog = false
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                })
            },

            save() {
                if (!this.$refs.form.validate()) return false;

                if (this.editedIndex > -1) {
                    // edit
                    let data = {
                        url: this.categories[this.editedIndex].links.update,
                        params: this.editedItem
                    }
                    this.$store.dispatch('apiUpdate', data)
                        .then((content) => {
                            this.$set(this.categories, this.editedIndex, content.data)
                            this.close()
                        })

                } else {
                    // create
                    let data = {
                        url: this.$store.state.api.category.index,
                        params: this.editedItem
                    }
                    this.$store.dispatch('apiCreate', data)
                        .then((content) => {
                            this.categories.push(content.data);
                            this.close()
                        })

                }
            },
        },
    }
</script>

<style scoped>

</style>
