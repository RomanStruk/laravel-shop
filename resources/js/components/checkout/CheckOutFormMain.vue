<template>
    <form :action="action" method="post" class="form-row" @submit.prevent="checkValidation()">
        <input type="hidden" name="_token" :value="csrf">
        <input type="hidden" name="city" :value="city_code">
        <template v-for="order in localStorage.basket_list">
            <input type="hidden" v-bind:name="'products['+order.id+'][id]'" :value="order.id"/>
            <input type="hidden" v-bind:name="'products['+order.id+'][count]'" :value="order.count"/>
        </template>
        <input type="hidden" name="shipping_method" v-bind:value="shipping_method">
        <input type="hidden" name="warehouse_code" v-bind:value="warehouse_code"
               v-if="shipping_method === 'novaposhta'">
        <input type="hidden" name="street" v-bind:value="street" v-if="shipping_method === 'courier'">
        <input type="hidden" name="house" v-bind:value="house" v-if="shipping_method === 'courier'">
        <input type="hidden" name="flat" v-bind:value="flat" v-if="shipping_method === 'courier'">
        <div class="col-lg-6 col-md-6">
            <div class="card card-primary">
                <div class="card-body">
                    <div v-if="next_steep===1">
                        <h3>Контактні дані</h3>
                        <!-- Section Title Start End -->
                        <div class="coupon-accordion">
                            <!-- ACCORDION START -->
                            <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                            <div id="checkout-login" class="coupon-content">
                                <div class="coupon-info">
                                    <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras
                                        sed est
                                        sit
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
                    </div>

                    <div v-if="next_steep===2">
                        <h3>Вибір способів доставки й оплати</h3>
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

                                <div :style="{'display': $v.city_code.$error?'block':'none'}" class="invalid-feedback" v-if="!$v.city_code.required">Поле обовязкове до заповнення!</div>
                            </div>
                        </div>
                        <!--Shipping-->
                        <fieldset class="form-group border-bottom" > <!-- :style="selected === false ? 'opacity:0.5;' : ''"-->
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
                                        <label class="custom-control-label" for="gridRadios1">Кур'єр на вашу адресу</label>
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
                                                    <input v-model="flat" id="address_flat" type="text"
                                                           class="form-control"
                                                           @blur="$v.flat.$touch()"
                                                           :class="{'is-invalid': $v.flat.$error}"
                                                    >
                                                </div>
                                            </div>
                                            <div :style="{'display': $v.street.$error?'block':'none'}" v-if="!$v.street.required" class="invalid-feedback" >Вкажіть вулицю для доставки</div>
                                            <div :style="{'display': $v.house.$error?'block':'none'}" class="invalid-feedback" v-if="!$v.house.required">Вкажіть будинок для доставки</div>
                                            <div :style="{'display': $v.flat.$error?'block':'none'}" class="invalid-feedback" v-if="!$v.flat.required">Вкажіть квартиру для доставки</div>
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
                                        <label class="custom-control-label" for="novaposhta">Самовивіз з Нової Пошти</label>
                                        <div class="form-group" v-if="shipping_method === 'novaposhta'">
                                            <label for="warehouses">Виберіть відповідне відділення:</label>
                                            <select class="custom-select custom-select-sm"
                                                    id="warehouses"
                                                    v-model="warehouse_code"
                                                    @blur="$v.warehouse_code.$touch()"
                                                    v-bind:class="{'is-invalid': $v.warehouse_code.$error}"
                                            >
                                                <option v-for="house in warehouses" :value="house.code">{{house.title}}</option>
                                                <option disabled>Нема мого відділення</option>
                                            </select>
                                            <div class="invalid-feedback" v-if="!$v.warehouse_code.required">Вкажіть відділення для доставки!</div>
                                        </div>
                                        <div class="invalid-feedback" v-if="!$v.shipping_method.required">Поле обовязкове до заповнення!</div>
                                        <div class="invalid-feedback" v-if="!$v.shipping_method.mustBeCool" >Виберіть один з доступних способів доставки</div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <!--Payment-->
                        <fieldset class="form-group" :style="selected === false ? 'opacity:0.5;' : ''">
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
                                        <label class="custom-control-label" for="pay_method_first">Оплата при отриманні
                                            замовлення</label>
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
                                        <label class="custom-control-label" for="pay_method_second">Google Pay</label>
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
                                        <label class="custom-control-label" for="pay_method_thirty">Оплатити зараз карткою
                                            Visa/Mastercard</label>
                                    </div>
                                    <div :style="{'display': $v.payment_method.$error?'block':'none'}" class="invalid-feedback" v-if="!$v.payment_method.mustBePayment" >Виберіть один з доступних способів оплати</div>
                                </div>
                            </div>
                        </fieldset>
                        <!--Comment-->
                        <div class="row form-group" :style="selected === false ? 'opacity:0.5;' : ''">
                            <label class="col-sm-3 col-form-label" for="comment">Коментар</label>
                            <div class="col-sm-9">
                                <textarea v-model="comment" id="comment" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" @click.prevent="nextSteep()">Далі</button>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="your-order">
                <h3>Ваше замовлення</h3>
                <div class="your-order-table table-responsive">
                    <table>
                        <thead>
                        <tr>
                            <th class="product-name">Продукт</th>
                            <th class="product-total">Всього</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cart_item"
                            v-for="order in localStorage.basket_list"
                        >

                            <td class="product-name">
                                {{ order.title}} <strong class="product-quantity"> × {{ order.count}}</strong></td>
                            <td class="product-total"><span class="amount">£{{ order.price}}</span></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr class="order-total">
                            <th>Всього замовлено:</th>
                            <td><strong><span class="amount">£{{localStorage.basket_list_sum}}</span></strong></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="payment-method">
                    <div class="payment-accordion">
                        <div class="order-button-payment"><input type="submit" name="s" value="Place order"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</template>

<script>
    import { required, requiredIf } from 'vuelidate/lib/validators';
    const mustBeMethod = (value) => (value === 'courier') || (value ===  'novaposhta');
    const mustBePayment = (value) => (value === 'receipt') || (value ===  'google-pay') || (value ===  'card');

    export default {
        data() {
            return {
                options: [],        // варіанти з пошуку міст
                city: {},           // вибране місто
                selected: false,    // чи вибране місто

                warehouses: {},     // доступні відділення для міста

                is_refresh: false,
                next_steep: 1,      // крок


                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

                //watch
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
        validations: {
            city_code : {
                required,
            },
            shipping_method: {
                required,
                mustBeMethod
            },
            payment_method:{
                required,
                mustBePayment
            },
            street: {
                required: requiredIf(function (nestedModel) {
                    // console.log(nestedModel);
                    return this.shipping_method === 'courier'
                })
            },             // вулиця
            house: {
                required: requiredIf(function (nestedModel) {
                    return this.shipping_method === 'courier'
                })
            },              // будинок
            flat: {
                required: requiredIf(function (nestedModel) {
                    return this.shipping_method === 'courier'
                })
            },               // квартира
            warehouse_code: {
                required: requiredIf(function (nestedModel) {
                    return this.shipping_method === 'novaposhta'
                })
            },     // код відділення
        },
        props: ['if_user_auth', 'action'],
        watch: {},
        mounted() {
            if (this.if_user_auth) {
                this.next_steep = 2;
            }
        },
        methods: {
            checkValidation(){

            },
            setSelected(value) {
                if (value !== null) {
                    this.selected = true;
                    this.city = value;
                    this.city_code = value.id;
                } else {
                    this.selected = false;
                    this.city = {};
                    this.city_code = '';
                }
                this.$v.city_code.$touch();
                this.loadWarehouses();
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
                    console.log(this.warehouses);
                })
            },
        }
    }
</script>

<style scoped>

</style>
