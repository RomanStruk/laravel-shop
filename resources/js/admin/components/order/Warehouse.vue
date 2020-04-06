<template>
    <div>
        <select name="warehouse_ref" id="warehouse" class="form-control">
            <option>--Не вибрано відділення--</option>
            <option v-for="(value, key) in $store.getters.WAREHOUSES"
                    :value="key"
                    :selected="key == warehouse_ref"
            >
                {{value}}
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        name: "Warehouse",
        data: function(){
            return {
            }
        },
        props:[
            'warehouse_ref'        // selected
        ],
        mounted() {
            console.log(this.$store.getters.WAREHOUSES);
            if (this.warehouses){
                this.$store.commit('ADD_WAREHOUSE', this.warehouses);
            }
            console.log('Component mounted.');
            // console.log(this.$root.warehouses);
        },
        methods: {


        }
    }
</script>

<style scoped>

</style>
