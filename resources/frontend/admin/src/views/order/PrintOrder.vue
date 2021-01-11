<template>
<div v-if="order != null" style="padding: 50px;">
    <h1>Рахунок-фактура #{{order.order_id}}</h1>
    <table class="table table-bordered">
        <thead class="">
        <tr>
            <th class="text-left">Деталі замовлення</th>
            <th>Користувач</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-left col-5">
                <b>Дата створення</b> {{order.created_at}}<br>
                <b>Індитифікатор</b>: {{order.order_id}}<br>
                <b>Спосіб оплати</b>
                <template v-if="order.payment.method === 'receipt'">Готівкою при доставці</template>
                <template v-if="order.payment.method === 'google-pay'">Google Pay</template>
                <template v-if="order.payment.method === 'card'">Оплатита карткою Visa/Mastercard</template>

                <template v-if="order.payment.paid === 0">(Оплачено)</template>
                <template v-if="order.payment.paid === 1">(Не оплачено)</template>
                <br>
                <b>Спосіб доставки</b>
                <template v-if="order.shipping.method === 'courier'">Кур'єр</template>
                <template v-if="order.shipping.method === 'novaposhta'">Самовивіз з Нової Пошти</template>
                <br>
            </td>
            <td class="col-8">
                <b>Ім'я:</b> {{order.user.full_name}}<br>
                <b>E-mail:</b> {{order.user.email}}<br>
                <b>Телефон:</b> {{order.user.detail.phone}}<br>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="table table-bordered">
        <thead class="">
        <tr>
            <th class="text-left">Адреса доставки</th>
            <th>Коментар замовника</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-left col-5">
                {{order.shipping.city.title}}
                <br>
                {{order.shipping.address.title}}
            </td>
            <td class="col-8">{{order.comment}}</td>
        </tr>
        </tbody>
    </table>

    <table class="table table-bordered">
        <thead class="">
        <tr>
            <th class="text-center">#id</th>
            <th class="text-left">Товар</th>
            <th class="text-left">Категорія</th>
            <th class="text-right">Quantity</th>
            <th class="text-right">Ціна за одиницю</th>
            <th class="text-right">Total</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="orderProduct in order.order_products" v-bind:key="orderProduct.order_product_id">
            <td class="text-center">{{orderProduct.order_product_id}} </td>
            <td class="text-left">{{orderProduct.product_title}}</td>
            <td class="text-left">{{orderProduct.product_category}}</td>
            <td class="text-right">{{orderProduct.quantity}}</td>
            <td class="text-right">{{orderProduct.price}}</td>
            <td class="text-right">{{orderProduct.total}}</td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">Sub-Total</td>
            <td class="text-right">{{order.total_products_price}}</td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">Єдиний тариф доставки</td>
            <td class="text-right">{{order.shipping.shipping_rate}} </td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">Total</td>
            <td class="text-right">{{order.total_price}}</td>
        </tr>
        </tbody>
    </table>
</div>
</template>

<script>
    export default {
        name: "PrintOrder",
        data: () => ({
            isLoading: false,
        }),

        computed: {
            order: {
                get() {
                    return this.$store.state.apiLoadedData.data
                }
            }
        },
        created() {
            this.initialize()
        },
        methods: {
            initialize() {
                this.loading = true
                this.$store.dispatch('getApiContent', {url: this.$route.query.order})
                    .finally(() => {
                        this.loading = false
                    });
            },
        }
    }
</script>

<style>

</style>
