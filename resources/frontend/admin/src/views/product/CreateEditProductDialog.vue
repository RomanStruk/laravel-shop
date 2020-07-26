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
                    <v-btn dark text @click="closeDialog()">Save</v-btn>
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
                    <v-stepper-content
                        step="1"
                    >
                        <v-form
                            class="mb-12"
                        >
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
                                :items="[editedItem.category]"
                                v-model="editedItem.category_id"
                                label="Категорія"
                            ></v-autocomplete>
                            <v-text-field
                                label="Ціна"
                                v-model="editedItem.price"
                            ></v-text-field>
                            <v-switch
                                v-model="editedItem.visibility"
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
                        <UploadImages v-bind:bind-to-product="false" :media-files="editedItem.media"></UploadImages>

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
                                    <v-text-field label="Постачальник товару"></v-text-field>
                                </v-col>
                                <v-col>
                                    <v-text-field label="Кількість"></v-text-field>
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
                }
            }
        },

        computed: {

            formTitle() {
                return this.edited ? 'Редагувати товар' : 'Додавання товару'
            },

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
                        this.editedItem = this.defaultItem;
                    }
                },
                deep: true,
            }
        },
        methods: {
            onFiltersProduct(val){
                this.editedItem.filters = val;
                console.log(val)
            },
            onRelatedProducts(val){
                this.editedItem.related = val;
                console.log(val)
            },
            getProduct(){

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
