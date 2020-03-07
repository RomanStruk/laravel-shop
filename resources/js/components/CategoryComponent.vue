<template>
    <div class="single-sidebar">
        <div class="group-title">
            <h2>категорії</h2>
        </div>
            <div class="list-group list-group-flush">
                <Category-item-component
                    v-for="(categories, index) in categoriesData"
                    :key="categories.id"
                    class="list-group-item list-group-item-action pl-0 pb-0 pt-0"
                    :item="categories"
                    @emit-choose-category="functionOnEmitChooseCategory"
                ></Category-item-component>
            </div>
    </div>
</template>

<script>

    import CategoryItemComponent from "./CategoryItemComponent";
    export default {
        components: {CategoryItemComponent},
        data: function(){
            return {
                categoriesData: [],
            }
        },
        mounted() {
            this.categories();
            //this.treeData = this.categoriesData;

            console.log('CategoryService Component mounted.');
        },
        methods: {
            functionOnEmitChooseCategory: function(id){
                console.log(id);
                this.$emit('event-choose-category', id)
            },
            categories: function(){
                axios.get('/category/get/json').then((response) => {
                    console.log(response.data);
                    this.categoriesData = response.data; // обєднання всії завантажених даних
                });
                this.is_refresh = false;
            }
        }
    }
</script>
<style>

</style>
