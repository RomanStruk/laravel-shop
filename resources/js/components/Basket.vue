<template>
    <li>
        <a href="#">
            <i class="fa fa-shopping-basket"></i>
            <span class="cart-counter">{{localStorage.basket_list.length}}</span>
        </a>
        <ul class="ht-dropdown main-cart-box">
            <li>
                <!-- Cart Box Start -->
                <div class="single-cart-box"
                     v-for="(basket, index) in localStorage.basket_list"
                     v-model="list"
                     :value="basket.price"
                >
                    <div class="cart-img">
                        <a href="#"><img :src="basket.img" alt="cart-image"></a>
                    </div>
                    <div class="cart-content">
                        <h6><a :href="basket.url">{{basket.id}} - {{basket.title}}</a></h6>
                        <span>{{basket.count}} × ${{basket.price}}</span>
                    </div>
                    <a class="del-icone"
                        @click="deleteBasketItem(index)"
                    ><i class="fa fa-window-close-o"></i></a>
                </div>
                <!-- Cart Box End -->
                <!-- Cart Footer Inner Start -->
                <div class="cart-footer fix">
                    <h5>total :<span class="f-right">${{localStorage.basket_list_sum}}</span></h5>
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
        data: function(){
            return {
                list:[]
            }
        },
        watch:{

        },
        mounted() {
            // console.log('Basket Component mounted.');
        },
        created() {
            //eventBus.$emit("userchange", this.testvarev);
        },
        methods: {
            deleteBasketItem(index){
                this.localStorage.basket_list_sum -=
                    this.localStorage.basket_list[index].price*
                    this.localStorage.basket_list[index].count;
                this.localStorage.basket_list.splice(index, 1);
            }
        }
    }
</script>
