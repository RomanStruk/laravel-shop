<template>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
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
            <v-stepper v-model="e1">
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
                            <v-text-field label="Alias"></v-text-field>
                            <v-autocomplete label="Категорія"></v-autocomplete>
                            <v-text-field label="Ціна"></v-text-field>
                            <v-switch
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
                    <v-stepper-content
                        step="2"
                    >
                        <v-form
                            class="mb-12"
                        >
                            <v-text-field label="Ключові Слова"></v-text-field>
                            <v-text-field label="Короткий опис"></v-text-field>
                            <v-textarea label="Детальний опис"></v-textarea>
                        </v-form>

                        <v-btn
                            color="primary"
                            @click="nextStep(2)"
                        >
                            Continue
                        </v-btn>

                        <v-btn text @click="previousStep()">Назад</v-btn>
                    </v-stepper-content>
                    <v-stepper-content
                        step="3"
                    >
                        <UploadImages v-bind:bind-to-product="false"></UploadImages>

                        <v-btn
                            color="primary"
                            @click="nextStep(3)"
                        >
                            Continue
                        </v-btn>

                        <v-btn text @click="previousStep()">Назад</v-btn>
                    </v-stepper-content>
                    <v-stepper-content
                        step="4"
                    >
                        <v-expansion-panels flat class="mb-2">
                            <v-expansion-panel>
                                <v-expansion-panel-header>Фірма виробник - Casio</v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <v-radio-group :mandatory="false">
                                        <v-radio label="Casio" value="radio-1"></v-radio>
                                        <v-radio label="Citizen" value="radio-2"></v-radio>
                                    </v-radio-group>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                            <v-expansion-panel>
                                <v-expansion-panel-header>Колір - Зелений</v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <v-radio-group :mandatory="false">
                                        <v-radio label="Casio" value="radio-1"></v-radio>
                                        <v-radio label="Citizen" value="radio-2"></v-radio>
                                    </v-radio-group>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>

                        <v-btn color="primary" @click="nextStep(4)">Continue</v-btn>
                        <v-btn text @click="previousStep()">Назад</v-btn>
                    </v-stepper-content>
                    <v-stepper-content
                        step="5"
                    >
                        <v-form
                            class="mb-12"
                        >
                            <v-text-field label="Постачальник товару"></v-text-field>
                            <v-text-field label="Кількість"></v-text-field>
                        </v-form>

                        <v-btn color="primary" @click="nextStep(5)">Continue</v-btn>
                        <v-btn text @click="previousStep()">Назад</v-btn>
                    </v-stepper-content>
                    <v-stepper-content
                        step="6"
                    >
                        <v-container class="py-0">
                            <v-row
                                align="center"
                                justify="start"
                            >
                                <v-col
                                    v-for="(selection, i) in selections"
                                    :key="selection.text"
                                    class="shrink"
                                >
                                    <v-chip
                                        :disabled="loading"
                                        close
                                        @click:close="selected.splice(i, 1)"
                                    >
                                        <v-icon>mdi-file-powerpoint-outline</v-icon>
                                        {{ selection.text }}
                                    </v-chip>
                                </v-col>

                                <v-col cols="12">
                                    <v-text-field
                                        ref="search"
                                        v-model="search"
                                        full-width
                                        hide-details
                                        label="Search"
                                        single-line
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>

                        <v-divider v-if="!allSelected"></v-divider>

                        <v-list>
                            <template v-for="item in listRelatedProducts">
                                <v-list-item
                                    v-if="!selected.includes(item)"
                                    :key="item.text"
                                    :disabled="loading"
                                    @click="selected.push(item)"
                                >
                                    <v-list-item-avatar>
                                        <v-icon
                                            :disabled="loading"
                                        >mdi-file-powerpoint-outline
                                        </v-icon>
                                    </v-list-item-avatar>
                                    <v-list-item-title v-text="item.text"></v-list-item-title>
                                </v-list-item>
                            </template>
                        </v-list>
                        <v-btn color="primary">Зберегти</v-btn>
                        <v-btn text @click="previousStep()">Назад</v-btn>
                    </v-stepper-content>
                </v-stepper-items>
            </v-stepper>
        </v-card>
    </v-dialog>
</template>

<script>
    import UploadImages from "../media/UploadImages";

    export default {
        name: "CreateEditProductDialog",
        components: {UploadImages},
        data() {
            return {
                //related products
                relatedProducts: [
                    {
                        text: 'Nature',
                    },
                    {
                        text: 'Nightlife',
                    },
                    {
                        text: 'November',
                    },
                    {
                        text: 'Portland',
                    },
                    {
                        text: 'Biking',
                    },
                ],
                loading: false,
                search: '',
                selected: [],
                //end related products


                notifications: false,
                sound: true,
                widgets: false,

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
                    description: '',
                },
                defaultItem: {
                    title: '',
                    alias: '',
                    description: '',
                }
            }
        },

        computed: {
            allSelected() {
                return this.selected.length === this.relatedProducts.length
            },
            listRelatedProducts() {
                const search = this.search.toLowerCase()

                if (!search) return this.relatedProducts

                return this.relatedProducts.filter(item => {
                    const text = item.text.toLowerCase()

                    return text.indexOf(search) > -1
                })
            },
            selections() {
                const selections = []

                for (const selection of this.selected) {
                    selections.push(selection)
                }

                return selections
            },

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
            product() {
                if (this.product){
                    this.edited = true;
                    this.editedItem = this.product
                }else {
                    this.edited = false;
                    this.editedItem = this.defaultItem;
                }
            }
        },
        methods: {
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
