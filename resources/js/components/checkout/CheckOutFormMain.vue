<template>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card card-primary">
                <div class="card-body">
                    <div id="overlay" :style="{'display':is_refresh === true?'flex':'none'}">
                        <div class="w-100 d-flex justify-content-center align-items-center">
                            <div class="spinner"></div>
                        </div>
                    </div>
                    <div v-if="completed === true" class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5>Успіх</h5>
                        Замовлення #{{message.id}} успішно відправлено!<br>
                        Статус замовлення: {{message.text}}
                    </div>
                    <div v-if="completed === false" class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5>Помилка</h5>
                        Під час збереження замовлення сталась неочікувана помилка: {{ message.text }}
                    </div>
                    <div v-if="completed !== true">
                        <LoginComponent v-if="!status_auth" @changeStatus="login"></LoginComponent>

                        <FastRegisterComponent v-if="next_steep===1 && status_auth === false"
                                               @registered="login"></FastRegisterComponent>

                        <div v-if="next_steep===2">
                            <h5>Вибір способів доставки й оплати</h5>
                            <div class="row form-group">
                                <label class="col-sm-3 col-form-label">Місто <span class="required">*</span></label>
                                <div class="col-sm-9">

                                    <v-select label="name" :filterable="false" :options="options" @search="onSearch"
                                              @input="setSelected">
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

                                    <div :style="{'display': $v.city_code.$error?'block':'none'}"
                                         class="invalid-feedback" v-if="!$v.city_code.required">Поле обовязкове до
                                        заповнення!
                                    </div>
                                </div>
                            </div>
                            <!--Shipping-->
                            <fieldset class="form-group border-bottom" v-if="selected">
                                <!-- :style="selected === false ? 'opacity:0.5;' : ''"-->
                                <div class="row">
                                    <legend class="col-form-label col-sm-3 pt-0">Спосіб доставки</legend>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="gridRadios1"
                                                   value="courier"
                                                   v-model="shipping_method"
                                                   :key="'courier'"
                                                   @blur="$v.shipping_method.$touch()"
                                                   :class="{'is-invalid': $v.shipping_method.$error}"
                                            >
                                            <label class="custom-control-label" for="gridRadios1">Кур'єр на вашу
                                                адресу</label>
                                            <div class="form-group" v-if="shipping_method === 'courier'">
                                                <label>Адрес</label>
                                                <div class="form-row">
                                                    <div class="input-group col-6 input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">вул.</div>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                               id="address_street"
                                                               v-model="street"
                                                               @blur="$v.street.$touch()"
                                                               :class="{'is-invalid': $v.street.$error}"
                                                        >
                                                    </div>
                                                    <div class="input-group col-3 input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">буд.</div>
                                                        </div>
                                                        <input v-model="house" id="address_house" type="text"
                                                               class="form-control"
                                                               @blur="$v.house.$touch()"
                                                               :class="{'is-invalid': $v.house.$error}"
                                                        >
                                                    </div>
                                                    <div class="input-group col-3 input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">кв.</div>
                                                        </div>
                                                        <input v-model="flat" id="address_flat" type="number"
                                                               class="form-control"
                                                               @blur="$v.flat.$touch()"
                                                               :class="{'is-invalid': $v.flat.$error}"
                                                        >
                                                    </div>
                                                </div>
                                                <div :style="{'display': $v.street.$error?'block':'none'}"
                                                     v-if="!$v.street.required" class="invalid-feedback">Вкажіть вулицю
                                                    для доставки
                                                </div>
                                                <div :style="{'display': $v.house.$error?'block':'none'}"
                                                     class="invalid-feedback" v-if="!$v.house.required">Вкажіть будинок
                                                    для доставки
                                                </div>
                                                <div :style="{'display': $v.flat.$error?'block':'none'}"
                                                     class="invalid-feedback" v-if="!$v.flat.required">Вкажіть квартиру
                                                    для доставки
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input "
                                                   type="radio"
                                                   id="novaposhta"
                                                   value="novaposhta"
                                                   v-model="shipping_method"
                                                   :key="'novaposhta'"
                                                   @blur="$v.shipping_method.$touch()"
                                                   :class="{'is-invalid': $v.shipping_method.$error}"
                                            >
                                            <label class="custom-control-label" for="novaposhta">Самовивіз з Нової
                                                Пошти</label>
                                            <div class="form-group" v-if="shipping_method === 'novaposhta'">
                                                <label for="warehouses">Виберіть відповідне відділення:</label>
                                                <select class="custom-select custom-select-sm"
                                                        id="warehouses"
                                                        v-model="warehouse_code"
                                                        @blur="$v.warehouse_code.$touch()"
                                                        v-bind:class="{'is-invalid': $v.warehouse_code.$error}"
                                                >
                                                    <option v-for="house in warehouses" :value="house.code">
                                                        {{house.title}}
                                                    </option>
                                                    <option disabled>Нема мого відділення</option>
                                                </select>
                                                <div class="invalid-feedback" v-if="!$v.warehouse_code.required">Вкажіть
                                                    відділення для доставки!
                                                </div>
                                            </div>
                                            <div class="invalid-feedback" v-if="!$v.shipping_method.required">Поле
                                                обовязкове до заповнення!
                                            </div>
                                            <div class="invalid-feedback" v-if="!$v.shipping_method.mustBeCool">Виберіть
                                                один з доступних способів доставки
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--Payment-->
                            <fieldset class="form-group" v-if="selected">
                                <div class="row">
                                    <legend class="col-form-label col-sm-3 pt-0">Спосіб оплати</legend>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="pay_method_first"
                                                   v-model="payment_method"
                                                   value="receipt"
                                                   @blur="$v.payment_method.$touch()"
                                                   :class="{'is-invalid': $v.payment_method.$error}"
                                            >
                                            <label class="custom-control-label" for="pay_method_first">Оплата при
                                                отриманні замовлення</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input"
                                                   id="pay_method_second"
                                                   type="radio"
                                                   value="google-pay"
                                                   v-model="payment_method"
                                                   @blur="$v.payment_method.$touch()"
                                                   :class="{'is-invalid': $v.payment_method.$error}"
                                            >
                                            <label class="custom-control-label" for="pay_method_second">Google
                                                Pay</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input"
                                                   id="pay_method_thirty"
                                                   type="radio"
                                                   value="card"
                                                   v-model="payment_method"
                                                   @blur="$v.payment_method.$touch()"
                                                   :class="{'is-invalid': $v.payment_method.$error}"
                                            >
                                            <label class="custom-control-label" for="pay_method_thirty">Оплатити зараз
                                                карткою Visa/Mastercard</label>
                                        </div>
                                        <div :style="{'display': $v.payment_method.$error?'block':'none'}"
                                             class="invalid-feedback" v-if="!$v.payment_method.mustBePayment">Виберіть
                                            один з доступних способів оплати
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--Comment-->
                            <div class="row form-group" v-if="selected">
                                <label class="col-sm-3 col-form-label" for="comment">Коментар</label>
                                <div class="col-sm-9">
                                    <textarea v-model="comment" id="comment" cols="30" rows="5"
                                              class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div class="order-button-payment">
                                    <button
                                        class="btn"
                                        @click.prevent="formSubmit()"
                                        :disabled="$v.$invalid"
                                        v-if="next_steep===2"
                                    >Оформити замовлення
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <YourOrderProductsComponent></YourOrderProductsComponent>
        </div>

    </div>

</template>

<script>
    import {required, requiredIf, email} from 'vuelidate/lib/validators';
    import LoginComponent from "../auth/LoginComponent";
    import YourOrderProductsComponent from "./YourOrderProductsComponent";
    import FastRegisterComponent from "../auth/FastRegisterComponent";

    const mustBeMethod = (value) => (value === 'courier') || (value === 'novaposhta');
    const mustBePayment = (value) => (value === 'receipt') || (value === 'google-pay') || (value === 'card');

    export default {
        components: {FastRegisterComponent, YourOrderProductsComponent, LoginComponent},
        data() {
            return {
                //login
                status_auth: false,

                options: [],        // варіанти з пошуку міст
                city: {},           // вибране місто
                selected: false,    // чи вибране місто
                warehouses: {},     // доступні відділення для міста

                next_steep: 1,      // крок

                is_refresh: false,
                completed: null,
                message: {
                    id: null,
                    text: ''
                },

                //user
                email: '',
                full_name: '',
                phone: '',

                //order
                city_code: '',          // код міста
                shipping_method: '',    // метод доставки
                payment_method: '',     // метод оплати
                comment: '',            // коментар замовника

                street: '',             // вулиця
                house: '',              // будинок
                flat: '',               // квартира
                warehouse_code: '',     // код відділення

            }
        },
        mounted() {
            console.log(this.$store.getters.shoppingCart.length)
            if (this.$store.getters.shoppingCart.length === 0){
                window.location.href = '/shop';

            }
            if (this.if_user_auth || this.loggedIn) {
                this.status_auth = this.loggedIn;
                this.next_steep = 2;
            }
            // console.log(this.$store.state.basket_list)

            // let form = {products: {}};
            // for (let item of this.localStorage.basket_list) {
            //     form['products'][item.id] = {id: item.id, count: item.count};
            // }
            // console.log(form)
            // console.log(this.localStorage)
            // console.log('this.$store.state.shoppingCart')
            // console.log(this.$store.getters.shoppingCart)
            // console.log(this.$store.getters.shoppingCartSumPrice)

        },
        validations: {

            city_code: {
                required,
            },
            shipping_method: {
                required,
                mustBeMethod
            },
            payment_method: {
                required,
                mustBePayment
            },
            // вулиця
            street: {
                required: requiredIf(function (value) {
                    return this.shipping_method === 'courier'
                })
            },
            // будинок
            house: {
                required: requiredIf(function (value) {
                    return this.shipping_method === 'courier'
                })
            },
            // квартира
            flat: {
                required: requiredIf(function (value) {
                    return this.shipping_method === 'courier'
                })
            },
            // код відділення
            warehouse_code: {
                required: requiredIf(function (nestedModel) {
                    return this.shipping_method === 'novaposhta'
                })
            },
        },
        props: ['if_user_auth', 'action'],
        watch: {},
        computed: {
            loggedIn() {
                return this.$store.getters.loggedIn
            }
        },
        methods: {
            login: function (value) {
                this.status_auth = value;
                if (value) this.nextSteep();
            },
            formSubmit() {
                this.storeOrder();
            },
            storeOrder() {
                this.is_refresh = true;
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$store.state.token;
                let form = {
                    comment: this.comment,
                    method_pay: this.payment_method,
                    shipping_method: this.shipping_method,
                    city_code: this.city_code,
                    street: this.street,
                    house: this.house,
                    flat: this.flat,
                    warehouse_code: this.warehouse_code,
                    products: {}
                };
                for (let item of this.$store.getters.shoppingCart) {
                    form['products'][item.id] = {id: item.id, count: item.count};
                }
                axios.post('/api/v1/order', form).then((response) => {
                    this.$store.commit('destroyShoppingCart');  // Очистити корзину

                    this.completed = true;
                    this.message.id = response.data.id
                    this.message.text = response.data.status
                    this.is_refresh = false;
                }).catch((error) => {
                    this.completed = false;
                    this.message.text = error
                    this.is_refresh = false;
                    console.log('error');                             // debug error
                    console.log(error);                             // debug error
                });
            },
            setSelected(value) {
                if (value !== null) {
                    this.selected = true;
                    this.city = value;
                    this.city_code = value.id;
                    this.loadWarehouses();
                } else {
                    this.selected = false;
                    this.city = {};
                    this.city_code = '';
                }
                this.$v.city_code.$touch();
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
                this.next_steep = 2;
            },
            loadWarehouses: function () {
                axios.get('/api/v1/shipping/address?shipping_method=novaposhta&code=' + this.city.id).then((response) => {
                    this.warehouses = response.data;
                })
            },
        }
    }
</script>

<style>
    .spinner {
        height: 60px;
        width: 60px;
        margin: auto;
        display: flex;
        position: absolute;
        -webkit-animation: rotation .6s infinite linear;
        -moz-animation: rotation .6s infinite linear;
        -o-animation: rotation .6s infinite linear;
        animation: rotation .6s infinite linear;
        border-left: 6px solid rgba(0, 174, 239, .15);
        border-right: 6px solid rgba(0, 174, 239, .15);
        border-bottom: 6px solid rgba(0, 174, 239, .15);
        border-top: 6px solid rgba(0, 174, 239, .8);
        border-radius: 100%;
    }

    @-webkit-keyframes rotation {
        from {
            -webkit-transform: rotate(0deg);
        }
        to {
            -webkit-transform: rotate(359deg);
        }
    }

    @-moz-keyframes rotation {
        from {
            -moz-transform: rotate(0deg);
        }
        to {
            -moz-transform: rotate(359deg);
        }
    }

    @-o-keyframes rotation {
        from {
            -o-transform: rotate(0deg);
        }
        to {
            -o-transform: rotate(359deg);
        }
    }

    @keyframes rotation {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(359deg);
        }
    }

    #overlay {
        position: absolute;
        display: none;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5);
        z-index: 2;
        cursor: pointer;
    }



</style>
