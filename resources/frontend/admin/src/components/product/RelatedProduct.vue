<template>
    <div>
        <v-row>
            <v-col
                v-for="(selection, i) in selected"
                :key="selection.product_id"
                class="shrink"
            >
                <v-chip close
                        @click:close="selected.splice(i, 1)"
                >
                    {{ selection.title }}
                </v-chip>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="10">
                <v-autocomplete
                    v-model="model"
                    :items="relatedProducts"
                    :loading="isLoading"
                    :search-input.sync="search"
                    hide-no-data
                    clearable
                    item-text="title"
                    item-value="product_id"
                    label="Додати товар "
                    placeholder="Начніть вводити для пошуку"
                    prepend-icon="mdi-database-search"
                    return-object
                ></v-autocomplete>
            </v-col>
            <v-col cols="12" md="2">
                <v-btn color="primary" class="mt-2" @click="add" :disabled="!canAdd">
                    <v-icon>mdi-plus-circle</v-icon>
                </v-btn>
            </v-col>
        </v-row>
    </div>
</template>

<script>
    export default {
        name: "RelatedProduct",
        data: function () {
            return {
                selected: this.defaultItems,
                relatedProducts: [],
                isLoading: false,
                model: null,
                search: null,
            }
        },

        computed: {
            canAdd(){
                return true
            }
        },
        created() {
        },
        props: {
            defaultItems: Array
        },
        watch: {
            selected() {
                this.$emit('event-on-selected-related', this.selected)
            },
            model(val) {
                if (!val) return
                if (this.selected.some(item => item.product_id === val.product_id)) {

                    console.log("Object found inside the array.");

                } else {
                    this.selected.push(val)
                }

            },

            search(val) {
                if (!val) return

                // Items have already been requested
                if (this.isLoading) return

                this.isLoading = true

                // Lazily load input items
                let data = {
                    focus: this.$store.state.searchApi.products,
                    params: {
                        q: val
                    }
                }
                this.$store.dispatch('searchApi/getSearch', data)
                    .then(res => {
                        const {data} = res
                        this.relatedProducts = data;
                    })
                    .finally(() => (this.isLoading = false))
            },
        },

        methods: {
            add(){

            }
        },
    }
</script>

<style scoped>

</style>
