<template>
    <div class="row">
        <h3>Контактні дані</h3>
        <div class="row">

            <div class="col-md-12">
                <div class="checkout-form-list">
                    <label>Ім'я та прізвище <span class="required">*</span>
                        <input name="name" type="text" placeholder="" value=""/>
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="checkout-form-list">
                    <label>Місто <span class="required">*</span>
                        <input
                            v-model="city"
                            name="city" type="text" placeholder="" value=""/>
                    </label>
                    <div class="col-12">
                        <div class="list-group">
                            <span href="#" class="list-group-item list-group-item-action list-group-item-warning custom-cursor"
                               v-for="ct in cities.data"
                               @click="choose(ct.Description)"
                            >{{ct.Description}}</span>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <div class="checkout-form-list">
                    <label>Ел. пошта<span class="required">*</span>
                        <input name="email" type="email" placeholder="" value=""/></label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="checkout-form-list mb-30">
                    <label>Мобільний телефон <span class="required">*</span>
                        <input name="phone" type="text" placeholder="" value=""/></label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                city: '',
                cities: {},
                is_refresh: false,
                selected: false
            }
        },
        watch: {
            city: function () {
                if (!this.selected){
                    this.loadCities();
                }
                this.selected = false;
                console.log(this.city);                                  // debug
            }
        },
        methods: {
            choose: function(city){
                this.selected = true;
                this.city = city;
                this.cities = {};
            },
            loadCities: async function () {
                this.is_refresh = true;                             // заглушка під чаз завантаження
                await axios.post('api/shipping/city', {
                    'city': this.city,
                }).then((response) => {
                    this.cities = response.data;
                    console.log('Успіщний запит з city');                       // debug
                    console.log(response.data);                                  // debug
                }).catch(function (error) {
                    console.log(error);                             // debug error
                });
                this.is_refresh = false;                            // кінець заглушки під чаз завантаження
            }
        }
    }
</script>

<style scoped>
    .custom-cursor:hover{
        cursor: pointer;
    }
</style>
