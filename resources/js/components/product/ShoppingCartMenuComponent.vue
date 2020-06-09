<template>
    <li>
        <a href="#">
            <i class="fa fa-shopping-basket"></i>
            <span class="cart-counter">{{$store.getters.shoppingCart.length}}</span>
        </a>
        <ul class="ht-dropdown main-cart-box"  v-if="$store.getters.shoppingCart.length > 0">
            <li>
                <!-- Cart Box Start -->
                <div class="single-cart-box"
                     v-for="product in $store.getters.shoppingCart"
                >
                    <div class="cart-img">
                        <a href="#"><img :src="product.img" alt="cart-image"></a>
                    </div>
                    <div class="cart-content">
                        <h6><a :href="'/product/'+product.url">{{product.id}} - {{product.title}}</a></h6>
                        <span>{{product.count}} × ${{product.price}}</span>
                    </div>
                    <a class="del-icone"
                        @click="deleteBasketItem(product.id)"
                    ><i class="fa fa-window-close-o"></i></a>
                </div>
                <!-- Cart Box End -->
                <!-- Cart Footer Inner Start -->
                <div class="cart-footer fix">
                    <h5>total :<span class="f-right">${{$store.getters.shoppingCartSumPrice}}</span></h5>
                    <div class="cart-actions">
                        <a class="checkout" href="/checkout">Оформити замовлення</a>
                    </div>
                </div>
                <!-- Cart Footer Inner End -->
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        methods: {
            deleteBasketItem(id){
                this.$store.commit('pickUpFromShoppingCart', id)
            }
        }
    }
</script>
