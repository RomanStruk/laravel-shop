<template>
    <div class="col-12">
        <div class="overlay dark" v-if="is_refresh">
            <i class="fas fa-2x fa-sync-alt"></i>
        </div>
        <autocomplete-field
            v-bind:list="autocomplete"
            v-bind:input-name="'city'"
            v-bind:default-value="props_city_title"
            @enter-text="listeningResult"
            @search-text="search"
        ></autocomplete-field>
        <small id="passwordHelpInline" class="text-muted">
            {{selected_city_description}}
        </small>
        <input type="hidden" name="city_code" :value="selected_city_code">
        <input type="hidden" name="city_title" :value="search_text">
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
                method: 'novaposhta',
                cities: null,
                is_refresh:false,
                search_text: '',

                selected_city_code: '',
                selected_city_description: ''
            }
        },
        props:[
            'props_city_code',        // отримання від батьківського компонента даних
            'props_city_title',        // отримання від батьківського компонента даних
        ],
        mounted() {
            if( this.props_city_code !== '' ){
                this.seData(this.props_city_code);
            }
            this.selected_city_code = this.props_city_code;
        },
        methods: {
            // start when change some text of search
            search: async function(input) {
                if (input.length < 1) { return [] }
                this.search_text = input;
                await this.loadCities(input);
                this.autocomplete = {};
                for (const element of this.cities) {
                    this.autocomplete[element.code] = {
                        'name': element.title,
                        'description': element.description
                    };
                }
            },
            listeningResult:async function(data){
                this.selected_city_code = data.key;
                this.selected_city_description = this.autocomplete[data.key].description;
                this.seData(data.key);
            },

            loadCities: async function (input) {
                this.is_refresh = true;                             // заглушка під чаз завантаження
                await axios.get('/api/v1/shipping/method/'+this.method+'/city/'+input).then((response) => {
                    this.cities = response.data;
                }).catch(function (error) {
                    console.log(error);                             // debug error
                });
                this.is_refresh = false;                            // кінець заглушки під чаз завантаження
            },

            seData: async function(city_ref){
                await this.loadWarehouses(city_ref);
                if (this.warehouses){
                    let item = {};
                    for (const element of this.warehouses) {

                        // this.city = element.CityDescription;
                        item[element.code] = element.title;
                    }
                    this.$store.commit('ADD_WAREHOUSE', item)
                }
            },
            loadWarehouses: async function (city_ref) {
                this.method = $('input[name=shipping_method][checked=checked]').val();
                await axios.get('/api/v1/shipping/method/'+this.method+'/address/'+ city_ref).then((response) => {
                    this.warehouses = response.data;
                });
            },
        },
    };
</script>

<style >

</style>
