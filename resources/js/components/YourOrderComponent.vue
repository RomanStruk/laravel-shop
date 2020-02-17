<template>
    <div class="your-order">
        <h3>Ваше замовлення</h3>
        <div class="your-order-table table-responsive">
            <table>
                <thead>
                <tr>
                    <th class="product-name">Продукт</th>
                    <th class="product-total">Всього</th>
                </tr>
                </thead>
                <tbody>
                <tr class="cart_item"
                    v-for="order in localStorage.basket_list"t.html
                >
                    <td class="product-name">
                        {{ order.title}} <strong class="product-quantity"> × {{ order.count}}</strong></td>
                    <td class="product-total"><span class="amount">£{{ order.price}}</span></td>
                </tr>
                </tbody>
                <tfoot>
                <tr class="order-total">
                    <th>Всього замовлено:</th>
                    <td><strong><span class="amount">£{{localStorage.basket_list_sum}}</span></strong></td>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="payment-method">
            <div class="payment-accordion">
                <div class="order-button-payment"><input type="submit" value="Place order"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "YourOrderComponent",
        data() {
            return {

            }
        },
        watch:{

        },
        mounted() {
            console.log(this.localStorage.basket_list);
        },
        methods: {
            c(){

            }
        }
    }
</script>

<style scoped>

</style>
