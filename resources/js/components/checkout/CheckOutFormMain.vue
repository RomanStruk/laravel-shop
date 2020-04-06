<template>
    <div class="col-lg-6 col-md-6">
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
                            <input id="go_city"
                                   v-model="city"
                                   name="city" type="text" placeholder="" value=""/>
                        </label>
                        <div class="col-12">
                            <div class="list-group">
                            <span href="#"
                                  class="list-group-item list-group-item-action list-group-item-warning custom-cursor"
                                  v-for="ct in cities.data"
                                  @click="choose(ct.Description, ct.Ref)"
                            >{{ct.Description}}, {{ct.RegionsDescription}}, {{ct.AreaDescription}}</span>
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
            <div class="row">
                <button type="button" class="btn btn-primary"
                    @click="nextSteep()"
                >Далі</button>
            </div>
        </div>
        <div class="row mt-10" v-if="next_steep">
            <h3>Вибір способів доставки й оплати</h3>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">Доставка в <a href="#go_city">{{city}}</a></div>
                    <div class="col-md-5"></div>
                    <div class="col-md-4"><a href="#go_city">Змінити місто</a></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                        <label><input
                            v-model="type_delivery"
                            :key="'Courier'"
                            type="radio" name="type_delivery" value="Courier"> Кур'єр на вашу адресу</label>
                    </div>
                    <div class="col-md-4">59 грн</div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                        <label>
                            <input
                                v-model="type_delivery"
                                :key="'Pickup'"
                                type="radio" name="type_delivery" value="Pickup"> Самовивіз з Нової Пошти
                        </label>
                        <div class="form-group"
                            v-if="show_list"
                        >
                            <label for="exampleFormControlSelect1">Виберіть відповідне відділення:</label>
                            <select name="warehouse" class="form-control form-control-sm" id="exampleFormControlSelect1">
                                <option v-for="house in warehouses.data" :value="house.Ref">
                                    {{house.Description}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">60 грн</div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">Оплата</div>
                    <div class="col-md-9">
                        <label><input type="radio" name="pay_method" value="on_place"> Оплата при отриманні
                            замовлення</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <label><input type="radio" name="pay_method" value="google_pay"> Google Pay </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <label><input type="radio" name="pay_method" value="credit_card"> Оплатити зараз карткою
                            Visa/Mastercard </label>
                    </div>
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

                city_ref: '',
                warehouses: {},
                type_delivery: '',

                is_refresh: false,
                selected: false,
                show_list: false,
                next_steep: false
            }
        },
        watch: {
            city: function () {
                if (!this.selected) {
                    this.loadCities();
                }
                this.selected = false;
                console.log(this.city);                                  // debug
            },
            type_delivery: function () {
                if (this.type_delivery === 'Pickup') {
                    this.loadWarehouses();
                    this.show_list = true;
                }
                if (this.type_delivery === 'Courier') {
                    this.show_list = false;
                }
            }
        },
        methods: {
            nextSteep: function () {
                this.next_steep = true;
            },
            loadWarehouses: function () {
                axios.get('/api/v1/shipping/warehouses/'+ this.city_ref).then((response) => {
                    this.warehouses = response.data;
                    console.log(this.warehouses);
                })
            },
            choose: function (city, ref) {
                this.selected = true;
                this.city = city;
                this.city_ref = ref;
                this.cities = {};
                console.log(this.city_ref);                       // debug
            },
            loadCities: async function () {
                this.is_refresh = true;                             // заглушка під чаз завантаження
                await axios.get('/api/v1/shipping/city/'+this.city).then((response) => {
                    this.cities = response.data;
                }).catch(function (error) {
                    console.log(error);                             // debug error
                });
                this.is_refresh = false;                            // кінець заглушки під чаз завантаження
            }
        }
    }
</script>

<style scoped>
    .custom-cursor:hover {
        cursor: pointer;
    }
</style>
