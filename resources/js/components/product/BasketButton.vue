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
        data: function(){
            return {
                product: {
                    id: document.querySelector('#id_product').getAttribute('value'),                  // додати індитифікатор
                    count: 1,                                        // кількість
                    title: document.querySelector('.product-header').textContent,             // назва
                    price: Number(document.querySelector('.price').textContent),            // ціна
                    img: document.querySelector('#product_img').getAttribute('src'),                // зображення
                    url: document.querySelector('#alias').getAttribute('value')               // скороч назва
                }
            }
        },
        methods: {
            // function додавання в корзину
            onBasketList(){
                this.localStorage.basket_list.push({
                    id:     this.product.id,                    // додати індитифікатор
                    count:  Number(this.product.count),         // кількість
                    title:  this.product.title,                 // назва
                    price:  this.product.price,                 // ціна
                    img:    this.product.img,                   // зображення
                    url:    this.product.url                    // скороч назва
                });
                this.localStorage.basket_list_sum += this.product.price*Number(this.product.count);
            },
        }
    }
</script>

<style scoped>
    .custom-cursor:hover{
        cursor: pointer;
    }
</style>
