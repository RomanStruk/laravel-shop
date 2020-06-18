<template>
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

            <v-toolbar flat color="primary" dark>
                <v-toolbar-title>Додати замовлення</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-icon>mdi-content-save</v-icon>
                </v-btn>
                <v-btn icon>
                    <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
                <v-btn icon @click="dialog = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>

            </v-toolbar>
            <v-tabs vertical>
                <v-tab>
                    <v-icon left>mdi-account</v-icon>
                    Замовник
                    <v-spacer></v-spacer>
                </v-tab>
                <v-tab>
                    <v-icon left>mdi-clipboard-list</v-icon>
                    Товари
                    <v-spacer></v-spacer>
                </v-tab>
                <v-tab>
                    <v-icon left>mdi-home-city-outline</v-icon>
                    Спосіб доставки
                    <v-spacer></v-spacer>
                </v-tab>
                <v-tab>
                    <v-icon left>mdi-credit-card-outline</v-icon>
                    Спосіб оплати
                    <v-spacer></v-spacer>
                </v-tab>

                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <v-combobox
                                label="Користувач"
                                :rules="[v => !!v || 'Item is required']"
                                :loading="isLoading"
                            ></v-combobox>
                            <v-textarea label="Коментар замовника"></v-textarea>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <v-row class="px-6 py-3" align="center">
                                <v-col
                                    v-for="(selection, i) in selected"
                                    :key="selection.text"
                                    class="shrink"
                                >

                                    <v-menu
                                        bottom
                                        right
                                        transition="scale-transition"
                                        origin="top left"
                                    >
                                        <template v-slot:activator="{ on }">
                                            <v-chip
                                                pill
                                                v-on="on"
                                                :disabled="isLoading"
                                                close
                                                @click:close="selected.splice(i, 1)"
                                            >
                                                {{ selection.text }}
                                            </v-chip>
                                        </template>
                                        <v-card width="300">
                                            <v-list color="info" dark>
                                                <v-list-item>
                                                    <v-list-item-avatar>
                                                        <v-img
                                                            src="https://cdn.vuetifyjs.com/images/john.png"></v-img>
                                                    </v-list-item-avatar>
                                                    <v-list-item-content>
                                                        <v-list-item-title>Casio MQ-24-7</v-list-item-title>
                                                        <v-list-item-subtitle>Одежда, обувь и аксессуары
                                                        </v-list-item-subtitle>
                                                    </v-list-item-content>
                                                    <v-list-item-action>
                                                        <v-btn
                                                            icon
                                                            @click="selected.splice(i, 1)"
                                                        >
                                                            <v-icon>mdi-close-circle</v-icon>
                                                        </v-btn>
                                                    </v-list-item-action>
                                                </v-list-item>
                                            </v-list>
                                            <v-list>
                                                <v-list-item @click="() => {}">
                                                    <v-list-item-action>
                                                        <v-icon>mdi-package-variant-closed</v-icon>
                                                    </v-list-item-action>
                                                    <v-list-item-subtitle>Постачальник
                                                    </v-list-item-subtitle>
                                                </v-list-item>
                                                <v-list-item @click="() => {}">
                                                    <v-list-item-action>
                                                        <v-icon>mdi-playlist-plus</v-icon>
                                                    </v-list-item-action>
                                                    <v-list-item-subtitle>5 шт</v-list-item-subtitle>
                                                </v-list-item>
                                            </v-list>
                                        </v-card>
                                    </v-menu>
                                </v-col>
                            </v-row>
                            <v-row align-content="center">
                                <v-col cols="12" md="4">
                                    <v-combobox
                                        label="Товар"
                                        item-value="id"
                                        item-text="title"
                                        :search-input.sync="searchProducts"
                                        :items="products"
                                        :rules="[v => !!v || 'Item is required']"
                                        return-object
                                        v-model="selectedProduct"
                                        :loading="isLoading"
                                    ></v-combobox>
                                </v-col>

                                <v-col cols="12" md="3">
                                    <v-select
                                        label="Постачальник"
                                        item-value="id"
                                        item-text="text"
                                        :items="selectedProduct.syllables"
                                        :rules="[v => !!v || 'Item is required']"
                                    ></v-select>
                                </v-col>

                                <v-col cols="12" md="3">
                                    <v-text-field label="Кількість товарів"></v-text-field>
                                </v-col>

                                <v-col cols="12" md="1">
                                    <v-btn color="primary" icon>
                                        <v-icon>mdi-plus-circle</v-icon>
                                    </v-btn>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <v-combobox label="Введіть назву населеного пункту"></v-combobox>
                            <v-tabs>

                                <v-tab>
                                    Доставка кур'єром
                                </v-tab>
                                <v-tab>
                                    Доставка Новою Пошою
                                </v-tab>
                                <v-tab-item>
                                    <v-row>
                                        <v-col md="4">
                                            <v-text-field label="Вулиця"></v-text-field>
                                        </v-col>
                                        <v-col md="4">
                                            <v-text-field label="Будинок"></v-text-field>
                                        </v-col>
                                        <v-col md="4">
                                            <v-text-field label="Квартира"></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-tab-item>
                                <v-tab-item>
                                    <v-combobox label="Введіть відділення Нової Пошти"></v-combobox>
                                </v-tab-item>
                            </v-tabs>
                            <v-text-field label="Вартість доставки"></v-text-field>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <v-radio-group v-model="methodPay">
                                <template v-slot:label>
                                    <div>Спосіб оплати</div>
                                </template>
                                <v-radio value="receipt" label="Оплата при отриманні замовлення"></v-radio>
                                <v-radio value="google-pay" label="Google Pay"></v-radio>
                                <v-radio value="card" label="Оплата карткою Visa/Mastercard"></v-radio>
                            </v-radio-group>
                            <v-radio-group v-model="paid">
                                <template v-slot:label>
                                    <div>Оплата</div>
                                </template>
                                <v-radio value="1" label="Оплачено"></v-radio>
                                <v-radio value="0" label="Не оплачено"></v-radio>
                            </v-radio-group>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs>
        </v-card>

    </v-dialog>
</template>

<script>
    export default {
        name: "CreateOrderDialog",
        data: () => ({
            menu: false, //chips
            selected: [
                {
                    text: 'Android Watch BQ-1',
                    icon: 'mdi-map-marker',
                },
                {
                    text: 'Citizen AT0696-59E',
                    icon: 'mdi-bike',
                }
            ],
            row: null,
            methodPay: null,
            paid: null,
            valid: true,
            dialog: false,

            isLoading: false,
            products: [],
            search: null,
            searchProducts: null,
            selectedProduct: {id:null, title:null, syllables:[]}
        }),
        watch: {
            selectedProduct(){
                console.log(this.selectedProduct)
            },
            searchProducts(val) {
                // Items have already been loaded
                // if (this.itemsSearch.length > 0) return

                // Items have already been requested
                if (this.isLoading) return

                this.isLoading = true
                let data = {
                    focus: this.$store.state.searchApi.products,
                    params:{
                        q:val
                    }
                }
                this.$store.dispatch('searchApi/getSearch', data)
                    .then(res => {
                        const {count, data} = res
                        this.count = count
                        this.products = data;
                    })
                    .catch(err => {
                        console.log(err)
                    })
                    .finally(() => (this.isLoading = false))
            },
        }
    }
</script>

<style scoped>

</style>
