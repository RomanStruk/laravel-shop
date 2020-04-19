<template>
    <div class="col-12">
        <autocomplete-field
            v-bind:list="autocomplete"
            v-bind:input-name="'city'"
            v-bind:default-value="props_city"
            @enter-text="listeningResult"
            @search-text="search"
        ></autocomplete-field>
        <small id="passwordHelpInline" class="text-muted">
            {{selected_city_description}}
        </small>
        <input type="hidden" name="city_ref" :value="selected_city_ref">
    </div>
</template>

<script>
    import AutocompleteField from "../../components/AutocompleteField";
    export default {
        components: {
            AutocompleteField
        },
        data: function(){
            return {
                autocomplete:{},
                warehouses:{},
                cities: null,
                is_refresh:false,
                city:'',

                selected_city_ref: '',
                selected_city_description: ''
            }
        },
        props:[
            'props_city_ref',        // отримання від батьківського компонента даних
            'props_city'
        ],
        mounted() {
            this.seData(this.props_city_ref);
            this.city = this.props_city;
            this.selected_city_ref = this.props_city_ref;
        },
        methods: {
            search: async function(input) {
                if (input.length < 1) { return [] }
                console.log(input);
                this.city = input;
                await this.loadCities(input);
                // this.loadCities();
                this.autocomplete = {};
                for (const element of this.cities.data) {
                    this.autocomplete[element.Ref] = {
                        'name': element.Description,
                        'description': element.Description + ' '
                            + element.RegionsDescription  + ' '
                            + element.AreaDescription
                    };
                    // console.log(element);
                }
            },

            seData: async function(city_ref){
                await this.loadWarehouses(city_ref);
                if (this.warehouses.data){
                    let item = {};
                    for (const element of this.warehouses.data) {
                        item[element.Ref] = element.Description;
                    }
                    this.$store.commit('ADD_WAREHOUSE', item)
                }
            },

            listeningResult:async function(data){
                this.selected_city_ref = data.key;
                this.selected_city_description = this.autocomplete[data.key].description;
                this.seData(data.key);
            },

            loadCities: async function () {
                this.is_refresh = true;                             // заглушка під чаз завантаження
                await axios.get('/api/v1/shipping/city/'+this.city).then((response) => {
                    this.cities = response.data;
                    // console.log(this.cities);
                    // console.log(this.city);
                }).catch(function (error) {
                    console.log(error);                             // debug error
                });
                this.is_refresh = false;                            // кінець заглушки під чаз завантаження
            },
            loadWarehouses: async function (city_ref) {
                await axios.get('/api/v1/shipping/warehouses/'+ city_ref).then((response) => {
                    this.warehouses = response.data;
                    console.log(this.warehouses);
                    console.log('Load warehouses from server');
                })
            },
        },
    };
</script>

<style >

</style>
