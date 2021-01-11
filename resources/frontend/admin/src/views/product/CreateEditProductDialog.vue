<template>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition" >
        <v-card>
            <v-toolbar dark color="primary">
                <v-btn icon dark @click="closeDialog()">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
                <v-toolbar-title>{{formTitle}}</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn dark text @click="saveProduct()">Save</v-btn>
                </v-toolbar-items>
            </v-toolbar>

            <v-skeleton-loader
                v-if="loading"
            >
                <div class="d-flex justify-center">
                <v-progress-circular
                    indeterminate
                    color="primary"
                ></v-progress-circular>
                </div>
            </v-skeleton-loader>
            <v-stepper v-model="e1" v-else>
                <v-stepper-header>
                    <v-divider></v-divider>
                    <v-stepper-step
                        v-for="step in configSteps"
                        :rules="step.rules"
                        :step="step.step"
                        :complete="e1 > step.step"
                        editable
                        :key="step.step"
                    >
                        {{step.label}}
                    </v-stepper-step>
                    <v-divider></v-divider>
                </v-stepper-header>
                <v-stepper-items>
                    <v-stepper-content step="1">
                        <v-form class="mb-12">
                            <v-text-field
                                label="Назва товару"
                                v-model="editedItem.title"
                            ></v-text-field>
                            <v-text-field
                                label="Alias"
                                v-model="editedItem.alias"
                            ></v-text-field>
                            <v-autocomplete
                                item-text="name"
                                item-value="category_id"
                                :search-input.sync="categorySearch"
                                :items="categories"
                                v-model="editedItem.category_id"
                                label="Категорія"
                            ></v-autocomplete>
                            <v-text-field
                                label="Ціна"
                                v-model="editedItem.price"
                            ></v-text-field>
                            <v-switch
                                v-model="editedItem.status"
                                label="Опублікувати"
                            ></v-switch>
                        </v-form>

                        <v-btn
                            color="primary"
                            @click="nextStep(1)"
                        >
                            Continue
                        </v-btn>
                    </v-stepper-content>
                    <v-stepper-content step="2">
                        <v-form class="mb-12">
                            <v-text-field
                                label="Ключові Слова"
                                v-model="editedItem.keywords"
                            ></v-text-field>
                            <v-text-field
                                label="Короткий опис"
                                v-model="editedItem.description"
                            ></v-text-field>
                            <v-textarea
                                label="Детальний опис"
                                v-model="editedItem.content"
                            ></v-textarea>
                        </v-form>

                        <v-btn
                            color="primary"
                            @click="nextStep(2)"
                        >
                            Continue
                        </v-btn>

                        <v-btn text @click="previousStep()">Назад</v-btn>
                    </v-stepper-content>
                    <v-stepper-content step="3">
                        <UploadImages v-bind:bind-to-product="false" :media-files="editedItem.media" @event-on-selected-images="onImagesProduct"></UploadImages>

                        <v-btn color="primary" @click="nextStep(3)">Continue</v-btn>
                        <v-btn text @click="previousStep()">Назад</v-btn>
                    </v-stepper-content>
                    <v-stepper-content step="4">
                        <FilterProduct :default-items="editedItem.filters" @event-on-selected-filters="onFiltersProduct" class="mb-12"></FilterProduct>

                        <v-btn color="primary" @click="nextStep(4)">Continue</v-btn>
                        <v-btn text @click="previousStep()">Назад</v-btn>
                    </v-stepper-content>
                    <v-stepper-content step="5">
                        <v-form class="mb-12">
                            <div v-for="(item) in editedItem.syllable" :key="item.syllable_id" >
                                <v-chip pill class="primary" outlined>
                                    {{item.supplier.name}} - {{item.imported}}/{{item.remains}}/{{item.countAvailableRemains}}
                                </v-chip>
                            </div>
                            <v-row>
                                <v-col>
                                    <v-autocomplete
                                        v-model="editedItem.supplier_id"
                                        :items="supplierItems"
                                        :loading="isLoadingSuppliers"
                                        :search-input.sync="supplierSearch"
                                        hide-no-data
                                        hide-selected
                                        item-text="name"
                                        item-value="supplier_id"
                                        label="Постачальник товару"
                                        placeholder="Start typing to Search"
                                        prepend-icon="mdi-database-search"
                                    ></v-autocomplete>
                                </v-col>
                                <v-col>
                                    <v-text-field v-model="editedItem.imported" label="Кількість"></v-text-field>
                                </v-col>
                            </v-row>


                        </v-form>

                        <v-btn color="primary" @click="nextStep(5)">Continue</v-btn>
                        <v-btn text @click="previousStep()">Назад</v-btn>
                    </v-stepper-content>
                    <v-stepper-content step="6">
                        <RelatedProduct :default-items="editedItem.related" @event-on-selected-related="onRelatedProducts" class="mb-12"></RelatedProduct>
                        <v-btn text @click="previousStep()">Назад</v-btn>
                    </v-stepper-content>
                </v-stepper-items>
            </v-stepper>
        </v-card>
    </v-dialog>
</template>

<script>
    import UploadImages from "../media/UploadImages";
    import RelatedProduct from "../../components/product/RelatedProduct";
    import FilterProduct from "../../components/product/FilterProduct";

    export default {
        name: "CreateEditProductDialog",
        components: {FilterProduct, RelatedProduct, UploadImages},
        data() {
            return {
                loading: false,

                e1: 1,
                steps: 6,
                configSteps: [
                    {
                        label: 'Загальне',
                        step: "1",
                        editable: true,
                        complete: false,
                        rules: [() => this.validStep(1)]
                    },
                    {
                        label: 'Детальніше',
                        step: "2",
                        editable: true,
                        complete: false,
                        rules: [() => this.validStep(2)]
                    },
                    {
                        label: 'Зображення',
                        step: "3",
                        editable: true,
                        complete: false,
                        rules: [() => this.validStep(3)]
                    },
                    {
                        label: 'Фільтри',
                        step: "4",
                        editable: true,
                        complete: false,
                        rules: [() => this.validStep(4)]
                    },
                    {
                        label: 'Склад',
                        step: "5",
                        editable: true,
                        complete: false,
                        rules: [() => this.validStep(5)]
                    },
                    {
                        label: 'Пов\'язані товари',
                        step: "6",
                        editable: true,
                        complete: false,
                        rules: [() => this.validStep(6)]
                    }
                ],

                edited: false,
                editedItem: {
                    product_id: '',
                    title: '',
                    alias: '',
                    keywords: '',
                    description: '',
                    content: '',
                    price: '',
                    old_price: '',
                    quality: '',
                    status: '',
                    category: '',
                    syllable: [],
                    related:[],
                    filters:[],
                    media: []

                },
                defaultItem: {
                    product_id: '',
                    title: '',
                    alias: '',
                    keywords: '',
                    description: '',
                    content: '',
                    price: '',
                    old_price: '',
                    quality: '',
                    status: '',
                    category: '',
                    syllable: [],
                    related:[],
                    filters:[],
                    media: []
                },

                supplierItems:[],
                isLoadingSuppliers: false,
                supplierSearch: null,


                categories: [],
                categorySearch: null
            }
        },

        computed: {
            formTitle() {
                return this.edited ? 'Редагувати товар' : 'Додавання товару'
            }

        },

        props: ['dialog', 'product'],
        watch: {
            steps(val) {
                if (this.e1 > val) {
                    this.e1 = val
                }
            },
            product: {
                handler(link) {
                    // console.log(de)
                    if (this.product !== null) {
                        this.loading = true;
                        this.edited = true;
                        this.$store.dispatch('productApi/getProduct', link)
                            .then((data) => {
                                this.editedItem = data.data
                            })
                            .finally(() => (this.loading = false))
                    } else {
                        this.loading = false;
                        this.edited = false;
                        // this.$set(this.editedItem, this.defaultItem)
                        // this.editedItem = this.defaultItem;
                        Object.assign(this.editedItem, this.defaultItem)
                    }
                },
                deep: true,
            },
            categorySearch(){
                if (this.categories.length > 0) return

                // Items have already been requested
                // if (this.isLoadingSuppliers) return

                // this.isLoadingSuppliers = true

                // Lazily load input items
                let data = {url:this.$store.state.api.category.index, params:{}}
                this.$store.dispatch('getApiContent', data)
                    .then(res => {this.categories = res.data.data})
                    .catch(err => {console.log(err)})
                // .finally(() => (this.isLoadingSuppliers = false))
            },
            supplierSearch () {
                // Items have already been loaded
                if (this.supplierItems.length > 0) return

                // Items have already been requested
                if (this.isLoadingSuppliers) return

                this.isLoadingSuppliers = true

                // Lazily load input items
                let data = {url:this.$store.state.api.supplier.index, params:{}}
                this.$store.dispatch('getApiContent', data)
                    .then(res => {this.supplierItems = res.data.data})
                    .catch(err => {console.log(err)})
                    .finally(() => (this.isLoadingSuppliers = false))
            },
        },
        methods: {
            saveProduct(){
                if (this.edited) {
                    this.updateProduct()
                } else {
                    this.createProduct()
                }
            },
            createProduct(){
                let data = {
                    title: this.editedItem.title,
                    keywords: this.editedItem.keywords,
                    description: this.editedItem.description,
                    content: this.editedItem.content,
                    price: this.editedItem.price,
                    status: this.editedItem.status,
                    category_id: this.editedItem.category_id,
                    filters: [],
                    related: [],
                    media: [],
                    supplier_id: this.editedItem.supplier_id,
                    imported: this.editedItem.imported,
                };
                for (let m of this.editedItem.media){data.media.push(m.media_id)}
                for (let m of this.editedItem.related){data.related.push(m.product_id)}
                for (let m of this.editedItem.filters){data.filters.push(m.filter_id)}
                this.$store.dispatch('productApi/createProduct', data)
                    .then(response => {
                        this.edited = true
                        this.editedItem = response.data
                    })
                console.log('createProduct')
            },
            updateProduct(){
                console.log('updateProduct')
                let params = {
                    title: this.editedItem.title,
                    keywords: this.editedItem.keywords,
                    description: this.editedItem.description,
                    content: this.editedItem.content,
                    price: this.editedItem.price,
                    status: this.editedItem.status,
                    category_id: this.editedItem.category.category_id,
                    filters: [],
                    related: [],
                    media: [],
                    supplier_id: this.editedItem.supplier_id,
                    imported: this.editedItem.imported,
                };
                for (let m of this.editedItem.media){params.media.push(m.media_id)}
                for (let m of this.editedItem.related){params.related.push(m.product_id)}
                for (let m of this.editedItem.filters){params.filters.push(m.filter_id)}

                let data = {
                    url: this.editedItem.links.update,
                    params: params
                }
                this.$store.dispatch('apiUpdate', data)
                    // .then((data) => {this.editedItem = data.data;})
                    // .finally(()=>{this.updateMediaLoading = false})
            },
            onImagesProduct(val){
                this.editedItem.media = val;
            },
            onFiltersProduct(val){
                this.editedItem.filters = val;
                console.log(val)
            },
            onRelatedProducts(val){
                this.editedItem.related = val;
                console.log(val)
            },

            validStep(n) {
                n;
                return true;

            },
            closeDialog() {
                this.$emit('event-on-close-dialog')
            },
            nextStep(n) {
                if (this.validStep(n - 1)) {
                    this.configSteps[n - 1].complete = false
                }
                if (n === this.steps) {
                    this.e1 = 1
                } else {
                    this.e1 = n + 1
                }
            },
            previousStep() {
                if (this.e1 > 1 && this.e1 <= this.steps) {
                    this.e1--;
                } else {
                    this.e1 = 1
                }
            }
        }
    }
</script>

<style scoped>

</style>
