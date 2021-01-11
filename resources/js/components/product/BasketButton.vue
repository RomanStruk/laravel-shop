<template>
    <a href="#"
       @click.prevent="onBasketList()"
       class="add-cart"
    >add to cart</a>
</template>

<script>
    export default {
        name: "BasketButton",
        props: [
            'product',
            'count'
        ],
        methods: {
            // function додавання в корзину
            onBasketList() {
                this.$store.commit('putInShoppingCart', {
                    id: this.product.id,                    // додати індитифікатор
                    count: Number(this.count),              // кількість
                    title: this.product.title,              // назва
                    price: this.product.price,                 // ціна
                    img: this.product.media[0].url,          // зображення
                    url: this.product.alias                  // скороч назва
                })
            },
        }
    }
</script>

<style scoped>
</style>
