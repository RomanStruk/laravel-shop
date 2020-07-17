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
                    <CreateOrderDialog></CreateOrderDialog>
                    <v-btn v-if="order" icon :to="'/order/print?order='+order.links.self">
                        <v-icon color="teal lighten-1">mdi-printer</v-icon>
                    </v-btn>
                    <v-btn v-if="order" icon :to="'/order/print?order='+order.links.destroy">
                        <v-icon color="red">mdi-delete</v-icon>
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
                    height="100%"
                    v-else
                    :elevation="elevation"
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
                                    <v-list-item-title>{{order.status_description}}</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-calendar-range</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>{{order.created_at}}</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-calendar-edit</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>{{order.updated_at}}</v-list-item-title>
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
                    height="100%"
                    :elevation="elevation"
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
                                    <v-list-item-title>{{order.user.full_name}}</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-account-group-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title><template v-for="role in order.user.roles">{{role.name}} </template></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-email-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>{{order.user.email}}</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-phone-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>{{order.user.detail.phone}}</v-list-item-title>
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
                    height="100%"
                    :elevation="elevation"
                >
                    <v-toolbar flat>
                        <v-toolbar-title>
                            <v-icon left>mdi-truck</v-icon>
                            Доставка
                        </v-toolbar-title>
                        <v-spacer></v-spacer>

                        <EditShippingDialog></EditShippingDialog>


                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-list dense>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-truck-fast-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>
                                        <template v-if="order.shipping.method === 'courier'">Кур'єр</template>
                                        <template v-if="order.shipping.method === 'novaposhta'">Самовивіз з Нової Пошти</template>
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-home-city-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    {{order.shipping.city.title}}
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-train-car</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    {{order.shipping.address.title}}
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
                    height="100%"
                    v-else
                    :elevation="elevation"
                >
                    <v-toolbar flat>
                        <v-toolbar-title>
                            <v-icon left>mdi-cash</v-icon>
                            Оплата
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                        <EditPaymentDialog></EditPaymentDialog>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-list dense>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-credit-card-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>
                                        <template v-if="order.payment.method === 'receipt'">Готівкою при доставці</template>
                                        <template v-if="order.payment.method === 'google-pay'">Google Pay</template>
                                        <template v-if="order.payment.method === 'card'">Оплатита карткою Visa/Mastercard</template>

                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-account-cash-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>
                                        <template v-if="order.payment.paid === 0">Оплачено</template>
                                        <template v-if="order.payment.paid === 1">Не оплачено</template>
                                    </v-list-item-title>
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
                    :elevation="elevation"
                >
                    <v-toolbar flat>
                        <v-toolbar-title>
                            <v-icon left>mdi-clipboard-list</v-icon>
                            Products
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                        <EditProductsDialog></EditProductsDialog>
                    </v-toolbar>
                    <v-card-text>
                        <v-data-table
                            :headers="headers"
                            :items="orderProducts"
                            hide-default-footer
                        ></v-data-table>

                        <p style="text-align: right">
                            Товарів на суму:<b>{{order.total_products_price}} грн.</b><br>
                            Єдиний тариф доставки:<b>{{order.shipping.shipping_rate}} грн.</b><br>
                            Всього до оплати:<b>{{order.total_price}} грн.</b>
                        </p>
                    </v-card-text>
                </v-card>

                <v-spacer style="height: 20px;"></v-spacer>

                <v-skeleton-loader
                    v-if="loading"
                    height="94"
                    type="list-item-two-line"
                ></v-skeleton-loader>
                <v-card
                    v-else
                    :elevation="elevation"
                >
                    <v-toolbar flat>
                        <v-toolbar-title>
                            <v-icon left>mdi-comment</v-icon>
                            Коментар замовника
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-card-text>
                        {{order.comment}}
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
                    :elevation="elevation"
                >
                    <v-toolbar flat>
                        <v-toolbar-title>
                            <v-icon left>mdi-cart</v-icon>
                            Історія Замовленя
                        </v-toolbar-title>

                        <v-spacer></v-spacer>

                        <OrderHistoryDialog></OrderHistoryDialog>

                    </v-toolbar>
                    <v-card-text>
                        <v-list three-line disabled>
                            <v-list-item-group
                                v-model="selected"
                                multiple
                                active-class="success--text"
                            >
                                <template v-for="(item, index) in order.history">
                                    <v-list-item :key="item.history_id">
                                        <v-list-item-content>
                                            <v-list-item-title v-text="item.user.full_name"></v-list-item-title>
                                            <v-list-item-subtitle v-text="item.comment"></v-list-item-subtitle>
                                        </v-list-item-content>

                                        <v-list-item-action>
                                            <v-list-item-action-text v-text="item.date_added"></v-list-item-action-text>
                                            <br>
                                            <v-chip small outlined>{{item.status_description}}</v-chip>
                                        </v-list-item-action>

                                    </v-list-item>

                                    <v-divider
                                        v-if="index + 1 < order.history.length"
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
    import CreateOrderDialog from "./CreateOrderDialog";
    import OrderHistoryDialog from "./OrderHistoryDialog";
    import EditShippingDialog from "./EditShippingDialog";
    import EditProductsDialog from "./EditProductsDialog";
    import EditPaymentDialog from "./EditPaymentDialog";

    export default {
        name: "Show",
        components: {
            OrderHistoryDialog,
            CreateOrderDialog,
            EditShippingDialog,
            EditProductsDialog,
            EditPaymentDialog
        },
        data: () => ({
            dialogCreateOrder: false,

            loading: false,
            elevation: 5,
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
