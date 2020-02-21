<template>
    <div class="box-quantity">
        <label for="numeric"></label>
        <input name="numeric" id="numeric" type="number" min="1" value="1" class="number"
            v-model="product.count"
        >
        <a
           @click="onBasketList()"
           class="add-cart custom-cursor">add to cart</a>
    </div>
</template>

<script>
    export default {
        name: "BasketButton",
        props:[
            'data'
        ],
        data: function(){
            return {
                product: {
                    count: 1,                                        // кількість          // скороч назва
                }
            }
        },
        mounted() {
            console.log(this.data);
            console.log('this.data');
        },
        methods: {
            // function додавання в корзину
            onBasketList(){
                this.localStorage.basket_list.push({
                    id:     this.data.id,                    // додати індитифікатор
                    count:  Number(this.product.count),         // кількість
                    title:  this.data.title,                 // назва
                    price:  this.data.price,                 // ціна
                    img:    this.data.img,                   // зображення
                    url:    this.data.alias                    // скороч назва
                });
                this.localStorage.basket_list_sum += this.data.price*Number(this.product.count);
            },
        }
    }
</script>

<style scoped>
    .custom-cursor:hover{
        cursor: pointer;
    }
</style>
