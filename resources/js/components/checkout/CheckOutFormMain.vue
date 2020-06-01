<template>
    <div>
        <div v-if="!if_user_auth">
            <h3>Контактні дані</h3>
            <!-- Section Title Start End -->
            <div class="coupon-accordion">
                <!-- ACCORDION START -->
                <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                <div id="checkout-login" class="coupon-content">
                    <div class="coupon-info">
                        <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est sit
                            amet
                            ipsum luctus.</p>
                        <form action="#">
                            <p class="form-row-first">
                                <label>Username or email <span class="required">*</span></label>
                                <input type="text"/>
                            </p>
                            <p class="form-row-last">
                                <label>Password <span class="required">*</span></label>
                                <input type="text"/>
                            </p>
                            <p class="form-row">
                                <input type="submit" value="Login"/>
                                <label>
                                    <input type="checkbox"/>
                                    Remember me
                                </label>
                            </p>
                            <p class="lost-password">
                                <a href="#">Lost your password?</a>
                            </p>
                        </form>
                    </div>
                </div>
                <!-- ACCORDION END -->
            </div>
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
                <button type="button" class="btn btn-primary" @click="nextSteep()">Далі</button>
            </div>
        </div>

        <div v-if="next_steep || if_user_auth">
            <h3>Вибір способів доставки й оплати</h3>
            <div class="form-group row">
                <label for="inputCity" class="col-sm-3 col-form-label">Місто <span class="required">*</span></label>
                <div class="col-sm-9">

                    <v-select label="name" :filterable="false" :options="options" @search="onSearch" @input="setSelected">
                        <template slot="no-options">
                            Введіть назву населеного пункту для доставки
                        </template>
                        <template slot="option" slot-scope="option">
                            <div class="d-center">
                                {{ option.description }}
                            </div>
                        </template>
                        <template slot="selected-option" slot-scope="option">
                            <div class="selected d-center">
                                {{ option.description }}
                            </div>
                        </template>
                    </v-select>

                </div>
            </div>
            <fieldset class="form-group"  :style="selected === false ? 'opacity:0.5;' : ''">
                <div class="row">
                    <legend class="col-form-label col-sm-3 pt-0">Спосіб доставки</legend>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type_delivery" id="gridRadios1" value="Courier"
                                   v-model="type_delivery"
                                   :key="'Courier'">
                            <label class="form-check-label" for="gridRadios1">Кур'єр на вашу адресу</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type_delivery" id="gridRadios2"
                                   value="Pickup"
                                   v-model="type_delivery"
                                   :key="'Pickup'">
                            <label class="form-check-label" for="gridRadios2">Самовивіз з Нової Пошти</label>
                            <div class="form-group" v-if="show_list">
                                <label for="warehouses">Виберіть відповідне відділення:</label>
                                <select name="warehouse" class="form-control form-control-sm" id="warehouses">
                                    <option v-for="house in warehouses" :value="house.code">{{house.title}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="form-group" :style="selected === false ? 'opacity:0.5;' : ''">
                <div class="row">
                    <legend class="col-form-label col-sm-3 pt-0">Спосіб доставки</legend>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="pay_method_first"  name="pay_method" value="on_place">
                            <label class="form-check-label" for="pay_method_first">Оплата при отриманні замовлення</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="pay_method_second"  name="pay_method" value="google_pay">
                            <label class="form-check-label" for="pay_method_second">Google Pay</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="pay_method_thirty"  name="pay_method" value="credit_card">
                            <label class="form-check-label" for="pay_method_thirty">Оплатити зараз карткою Visa/Mastercard</label>
                        </div>
                    </div>
                </div>
            </fieldset>

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                options: [],

                city: '',

                warehouses: {},
                type_delivery: '',

                is_refresh: false,
                selected: false,
                show_list: false,
                next_steep: false
            }
        },
        props: ['if_user_auth'],
        watch: {
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
        mounted() {

        },
        methods: {
            setSelected(value) {
                this.selected = value !== null;
                this.city = value;
            },
            onSearch(search, loading) {
                if (search === '') return;
                loading(true);
                this.search(loading, search, this);
            },
            search: _.debounce((loading, search, vm) => {
                axios.get('/api/v1/search/shipping/city?shipping_method=novaposhta&q=' + search).then((response) => {
                    vm.options = response.data.data;
                }).catch(function (error) {
                    console.log(error);                             // debug error
                });
                loading(false);
            }, 350),

            nextSteep: function () {
                this.next_steep = true;
                this.if_user_auth = true;
            },
            loadWarehouses: function () {
                axios.get('/api/v1/shipping/address?shipping_method=novaposhta&code=' + this.city.id).then((response) => {
                    this.warehouses = response.data;
                    console.log(this.warehouses);
                })
            },
            change: function(){
                this.description = '';
                this.selected = false;
            },
        }
    }
</script>

<style scoped>
    .custom-cursor:hover {
        cursor: pointer;
    }
</style>
