<template>
    <div>
        <v-row align="center">
            <v-col
                v-for="(filter, i) in selected"
                :key="filter.filter_id"
                class="shrink"
            >

                <v-chip pill close
                        @click:close="selected.splice(i, 1)"
                >
                    {{ filter.filter_group.name }} - {{ filter.value }}
                </v-chip>
            </v-col>
        </v-row>
        <v-row align-content="center">
            <v-col cols="12" md="5">
                <v-autocomplete
                    v-model="modelFilterGroup"
                    label="Група фільтрів"
                    item-value="filter_group_id"
                    item-text="name"
                    :items="groupFilter"
                    :loading="isLoading"
                    :search-input.sync="search"
                    return-object
                ></v-autocomplete>
            </v-col>

            <v-col cols="12" md="5">
                <v-select
                    label="Фільтр"
                    item-value="filter_id"
                    item-text="value"
                    :items="filters"
                    v-model="modelFilter"
                    return-object
                ></v-select>
            </v-col>

            <v-col cols="12" md="2">
                <v-btn color="primary" class="mt-2" @click="add" :disabled="!catAdd">
                    <v-icon>mdi-plus-circle</v-icon>
                </v-btn>
            </v-col>
        </v-row>
    </div>
</template>

<script>
    export default {
        name: "FilterProduct",
        data: function () {
            return {
                selected: this.defaultItems,
                currentSelectedFilter: null,
                isLoading: false,
                modelFilter: null,
                modelFilterGroup: {},
                search: null,
                groupFilter: [],
                filters: []

            }
        },
        props: {
            defaultItems: Array
        },
        watch: {
            selected(){
                this.$emit('event-on-selected-filters', this.selected)
            },
            modelFilter(val) {
                if (!val) return
                this.currentSelectedFilter = {
                    filter_id: val.filter_id,
                    value: val.value,
                    filter_group: this.modelFilterGroup
                };

            },
            modelFilterGroup(val) {
                if (!val) return
                this.filters = val.filters
            },

            search(val) {
                if (!val) return

                // Items have already been requested
                if (this.isLoading) return

                this.isLoading = true

                // Lazily load input items
                let data = {
                    focus: this.$store.state.searchApi.filterGroups,
                    params: {
                        search: val
                    }
                }
                this.$store.dispatch('searchApi/getSearch', data)
                    .then(res => {
                        const {data} = res
                        this.groupFilter = data;
                    })
                    .finally(() => (this.isLoading = false))
            },
        },
        methods:{
            add(){
                this.selected.push(this.currentSelectedFilter)
            }
        },
        computed: {
            catAdd() {
                if (!this.currentSelectedFilter) return false
                if (!this.currentSelectedFilter.filter_group) return false
                return !this.selected.some(item => item.filter_group.filter_group_id === this.currentSelectedFilter.filter_group.filter_group_id);

            },

        },
    }
</script>

<style scoped>

</style>
