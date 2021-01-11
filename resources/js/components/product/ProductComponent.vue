<template>
    <div class="box-quantity">
        <label for="numeric"></label>
        <input name="numeric" id="numeric" type="number" min="1" value="1" class="number"
               v-model="count"
        >
        <basket-button :count="count" :product="product"></basket-button>
    </div>
</template>

<script>
    import BasketButton from "./BasketButton";
    export default {
        name: "ProductComponent",
        components: {BasketButton},
        props: ['product'],
        data: function(){
            return {
                count: 1,                                        // кількість
            }
        },
        methods: {

        }
    }
</script>

<style scoped>
</style>
