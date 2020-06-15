<template>
    <div>
        <v-row>
            <v-col>
                <v-toolbar flat color="grey lighten-4">
                    <v-toolbar-title>
                        <v-icon left>mdi-tools</v-icon>
                        Order (#267)
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialogCreateOrder" persistent max-width="600px">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn icon
                                   v-bind="attrs"
                                   v-on="on"
                            >
                                <v-icon>mdi-plus-circle</v-icon>
                            </v-btn>
                        </template>
                        <CreateOrder @onDialog="onDialogCreateOrder()"></CreateOrder>
                    </v-dialog>
                    <v-btn icon>
                        <v-icon>mdi-square-edit-outline</v-icon>
                    </v-btn>
                    <v-btn icon>
                        <v-icon>mdi-printer</v-icon>
                    </v-btn>
                </v-toolbar>

            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-skeleton-loader
                    v-if="loading"
                    height="94"
                    type="list-item-two-line"
                ></v-skeleton-loader>
                <v-card
                    min-width="300"
                    v-else
                >
                    <v-toolbar flat>
                        <v-toolbar-title>
                            <v-icon left>mdi-cart</v-icon>
                            Деталі замовлення
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-list dense>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-beaker-check-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>Очікує на розгляд</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-calendar-range</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>2020-06-09 20:49:13</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-credit-card-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>Готівкою при доставці</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-truck-fast-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>Кур'єр</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col>
                <v-skeleton-loader
                    v-if="loading"
                    height="94"
                    type="list-item-two-line"
                ></v-skeleton-loader>
                <v-card
                    v-else
                    min-width="300"
                >
                    <v-toolbar flat>
                        <v-toolbar-title>
                            <v-icon left>mdi-account</v-icon>
                            Інформація про клієнта
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-list dense>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-account-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>Roman Struk</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-account-group-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>Admin</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-email-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>admin@gmail.com</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-phone-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>+12345678901</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col>
                <v-skeleton-loader
                    v-if="loading"
                    height="94"
                    type="list-item-two-line"
                ></v-skeleton-loader>
                <v-card
                    v-else
                    min-width="300"
                >
                    <v-toolbar flat>
                        <v-toolbar-title>
                            <v-icon left>mdi-truck</v-icon>
                            Адреса доставки
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-list dense>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-home-city-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    Вільне Світловодський р-н Кіровоградська область

                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-train-car</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    вул. Вільхівка, буд. 5, кв. 13
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>

        <v-row>
            <v-col>
                <v-skeleton-loader
                    v-if="loading"
                    height="94"
                    type="list-item-two-line"
                ></v-skeleton-loader>
                <v-card
                    v-else
                >
                    <v-toolbar flat>
                        <v-toolbar-title>
                            <v-icon left>mdi-clipboard-list</v-icon>
                            Products
                        </v-toolbar-title>
                        <v-spacer></v-spacer>

                    </v-toolbar>
                    <v-card-text>
                        <v-data-table
                            :headers="headers"
                            :items="orderProducts"
                            hide-default-footer
                            class="elevation-1"
                        ></v-data-table>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col>
                <v-skeleton-loader
                    v-if="loading"
                    height="94"
                    type="list-item-two-line"
                ></v-skeleton-loader>
                <v-card
                    v-else
                >
                    <v-toolbar flat>
                        <v-toolbar-title>
                            <v-icon left>mdi-cart</v-icon>
                            Історія Замовленя
                        </v-toolbar-title>

                        <v-spacer></v-spacer>

                        <v-btn icon color="blue" large class="mr-1">
                            <v-icon>mdi-plus-circle</v-icon>
                        </v-btn>

                    </v-toolbar>
                    <v-card-text>
                        <v-list three-line disabled>
                            <v-list-item-group
                                v-model="selected"
                                multiple
                                active-class="success--text"
                            >
                                <template v-for="(item, index) in items">
                                    <v-list-item :key="item.history_id">
                                        <v-list-item-content>
                                            <v-list-item-title v-text="item.title"></v-list-item-title>
                                            <v-list-item-subtitle v-text="item.subtitle"></v-list-item-subtitle>
                                        </v-list-item-content>

                                        <v-list-item-action>
                                            <v-list-item-action-text v-text="item.action"></v-list-item-action-text>
                                            <br>
                                            <v-chip small outlined>{{item.headline}}</v-chip>
                                        </v-list-item-action>

                                    </v-list-item>

                                    <v-divider
                                        v-if="index + 1 < items.length"
                                        :key="'j'+item.history_id"
                                    ></v-divider>
                                </template>
                            </v-list-item-group>
                        </v-list>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
    import CreateOrder from "../../components/order/CreateOrder";

    export default {
        name: "Show",
        components: {CreateOrder},
        data: () => ({
            dialogCreateOrder: false,

            loading: false,
            headers: [
                {
                    text: '#id',
                    align: 'start',
                    value: 'product_id',
                    sortable: false,
                },
                {text: 'Товар', value: 'product_title'},
                {text: 'Категорія', value: 'product_category'},
                {text: 'Quantity', value: 'quantity'},
                {text: 'Ціна за одиницю', value: 'price'},
                {text: 'Total', value: 'total'},
            ],

            selected: [0],
            items: [
                {
                    history_id: 1,
                    action: '15 min',
                    headline: 'Очікує на розгляд',
                    title: 'Roman Struk',
                    subtitle: "I'll be in your neighborhood doing errands this weekend.",
                },
                {
                    history_id: 2,
                    action: '2 hr',
                    headline: 'Очікує на розгляд',
                    title: 'Roman Struk',
                    subtitle: "Wish I could come, but I'm out of town this weekend.",
                },
                {
                    history_id: 3,
                    action: '6 hr',
                    headline: 'Очікує на розгляд',
                    title: 'Roman Struk',
                    subtitle: 'Do you have Paris recommendations? Have you ever been?',
                },
                {
                    history_id: 4,
                    action: '12 hr',
                    headline: 'Очікує на розгляд',
                    title: 'Trevor Hansen',
                    subtitle: 'Create Order',
                },
                {
                    history_id: 5,
                    action: '18hr',
                    headline: 'Очікує на розгляд',
                    title: 'Britta Holt',
                    subtitle: 'We should eat this: Grate, Squash, Corn, and tomatillo Tacos.',
                },
            ],
            order: null
        }),
        created() {
            this.initialize()
        },
        computed: {
            orderProducts: {
                get() {
                    return this.order.order_products
                }
            }
        },
        methods: {
            onDialogCreateOrder(value) {
                this.dialogCreateOrder = value;
            },
            initialize() {
                this.loading = true
                this.$store.dispatch('getApiContent', {url: this.$route.query.order})
                    .then(() => {
                        this.order = this.$store.state.apiLoadedData.data
                    })
                    .catch((error) => {
                        this.$store.commit('SNAKE_BAR', {
                            snackStatus: true,
                            snackText: error.message,
                            snackColor: 'error'
                        })
                    })
                    .finally(() => {
                        this.loading = false
                    });
            },
        }
    }
</script>

<style scoped>

</style>
