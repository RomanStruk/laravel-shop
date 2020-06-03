<template>
    <form :action="action" method="post" class="form-row" @submit.prevent="checkValidation()">
        <input type="hidden" name="_token" :value="csrf">
        <input type="hidden" name="city" :value="form_city_code">
        <template v-for="order in localStorage.basket_list">
            <input type="hidden" v-bind:name="'products['+order.id+'][id]'" :value="order.id"/>
            <input type="hidden" v-bind:name="'products['+order.id+'][count]'" :value="order.count"/>
        </template>
        <input type="hidden" name="shipping_method" v-bind:value="form_shipping_method">
        <input type="hidden" name="warehouse_code" v-bind:value="form_warehouse_code"
               v-if="form_shipping_method === 'novaposhta'">
        <input type="hidden" name="street" v-bind:value="form_street" v-if="form_shipping_method === 'courier'">
        <input type="hidden" name="house" v-bind:value="form_house" v-if="form_shipping_method === 'courier'">
        <input type="hidden" name="flat" v-bind:value="form_flat" v-if="form_shipping_method === 'courier'">
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
                                <div class="text-danger mt-2 text-small">
                                    <div v-if="errors.form_city_code.required">{{validate_messages.require}}</div>
                                </div>
                            </div>
                        </div>
                        <!--Shipping-->
                        <fieldset class="form-group border-bottom" :style="selected === false ? 'opacity:0.5;' : ''">
                            <div class="row">
                                <legend class="col-form-label col-sm-3 pt-0">Спосіб доставки</legend>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="gridRadios1"
                                               value="courier"
                                               v-model="shipping_method"
                                               :key="'courier'"
                                        >
                                        <label class="form-check-label" for="gridRadios1">Кур'єр на вашу адресу</label>
                                        <div class="form-group" v-if="shipping_method === 'courier'">
                                            <label>Адрес</label>
                                            <div class="form-row">
                                                <div class="input-group col-6 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">вул.</div>
                                                    </div>
                                                    <input v-model="street" type="text" class="form-control"
                                                           id="address_street">
                                                </div>
                                                <div class="input-group col-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">буд.</div>
                                                    </div>
                                                    <input v-model="house" id="address_house" type="text"
                                                           class="form-control">
                                                </div>
                                                <div class="input-group col-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">кв.</div>
                                                    </div>
                                                    <input v-model="flat" id="address_flat" type="text"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="novaposhta"
                                               value="novaposhta"
                                               v-model="shipping_method"
                                               :key="'novaposhta'">
                                        <label class="form-check-label" for="novaposhta">Самовивіз з Нової Пошти</label>
                                        <div class="form-group" v-if="shipping_method === 'novaposhta'">
                                            <label for="warehouses">Виберіть відповідне відділення:</label>
                                            <select v-model="warehouse_code" class="form-control form-control-sm"
                                                    id="warehouses">
                                                <option v-for="house in warehouses" :value="house.code">
                                                    {{house.title}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-danger mt-2 text-small">
                                        <div v-if="errors.form_shipping_method.required">Виберіть спосіб доставки товару</div>
                                        <div v-if="errors.form_street.required">Вкажіть вулицю для доставки</div>
                                        <div v-if="errors.form_house.required">Вкажіть будинок для доставки</div>
                                        <div v-if="errors.form_flat.required">Вкажіть квартиру для доставки</div>
                                        <div v-if="errors.form_warehouse_code.required">Вкажіть відділення для доставки</div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <!--Payment-->
                        <fieldset class="form-group" :style="selected === false ? 'opacity:0.5;' : ''">
                            <div class="row">
                                <legend class="col-form-label col-sm-3 pt-0">Спосіб оплати</legend>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="pay_method_first"
                                               v-model="payment_method"
                                               value="receipt">
                                        <label class="form-check-label" for="pay_method_first">Оплата при отриманні
                                            замовлення</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="pay_method_second"
                                               v-model="payment_method"
                                               value="google-pay">
                                        <label class="form-check-label" for="pay_method_second">Google Pay</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="pay_method_thirty"
                                               v-model="payment_method"
                                               value="card">
                                        <label class="form-check-label" for="pay_method_thirty">Оплатити зараз карткою
                                            Visa/Mastercard</label>
                                    </div>
                                    <div class="text-danger mt-2 text-small">
                                        <div v-if="errors.form_payment_method.required">{{validate_messages.require}}</div>
                                    </div>
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
    export default {
        data() {
            return {
                options: [],

                city: {},

                warehouses: {},

                is_refresh: false,
                selected: false,
                next_steep: 1,

                validate_messages: {
                    'require': 'Поле обовязкове до заповнення!',
                },
                errors: {
                    form_city_code: {},
                    form_comment: {},
                    form_shipping_method: {},
                    form_street:{},
                    form_house:{},
                    form_flat:{},
                    form_warehouse_code:{},
                    form_payment_method:{}

                },

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

                // form data for send
                form_city_code: '',

                form_products: [],
                form_shipping_method: '',
                form_comment: '',

                form_street: '',
                form_house: '',
                form_flat: '',
                form_warehouse_code: '',

                form_payment_method: ''

            }
        },
        props: ['if_user_auth', 'action'],
        watch: {
            shipping_method: function () {
                this.validate();
                if (this.shipping_method === 'novaposhta') {
                    this.loadWarehouses();
                    this.form_shipping_method = 'novaposhta';
                }
                if (this.shipping_method === 'courier') {
                    this.form_shipping_method = 'courier';
                }
            },
            street:function () {
                this.validate();
            },
            house:function () {
                this.validate();
            },
            flat:function () {
                this.validate();
            },
            city_code:function () {
                this.validate();
            },
            warehouse_code:function () {
                this.validate();
            },
            payment_method:function () {
                this.validate();
            }
        },
        mounted() {
            if (this.if_user_auth) {
                this.next_steep = 2;
            }
        },
        methods: {
            validate() {
                this.errors.form_city_code["required"] = false;
                this.errors.form_shipping_method.required = false;
                this.errors.form_street.required = false;
                this.errors.form_house.required = false;
                this.errors.form_flat.required = false;
                this.errors.form_warehouse_code.required = false;
                this.errors.form_payment_method.required = false;
                // city
                if (this.city_code === ''){
                    this.errors.form_city_code["required"] = true;
                    this.form_city_code = '';
                }else {
                    this.form_city_code = this.city_code;
                }

                // shipping_method
                if ((this.shipping_method !== 'courier') && (this.shipping_method !==  'novaposhta')){
                    this.errors.form_shipping_method.required = true;
                    this.form_shipping_method = '';
                }else {
                    this.form_shipping_method = this.shipping_method;
                }
                if (this.shipping_method === 'courier'){
                    if (this.street ===''){
                        this.errors.form_street.required = true;
                        this.form_street = '';
                    }else {
                        this.form_street = this.street;
                    }
                    if (this.house ===''){
                        this.errors.form_house.required = true;
                        this.form_house = '';
                    }else {
                        this.form_house = this.house;
                    }
                    if (this.flat ===''){
                        this.errors.form_flat.required = true;
                        this.form_flat = '';
                    }else {
                        this.form_flat = this.flat;
                    }
                }

                if (this.shipping_method === 'novaposhta') {
                    if (this.warehouse_code === '') {
                        this.errors.form_warehouse_code.required = true;
                        this.form_warehouse_code = '';
                    } else {
                        this.form_warehouse_code = this.warehouse_code;
                    }
                }
                // comment
                this.errors.form_comment["required"] = this.form_comment === '';

                // payment_method
                if ((this.payment_method !== 'receipt') && (this.payment_method !==  'google-pay') && (this.payment_method !==  'card')){
                    this.errors.form_payment_method.required = true;
                    this.form_payment_method = '';
                }else {
                    this.form_payment_method = this.payment_method;
                }
            },
            checkValidation(){
                this.validate();
                for ( let key in this.errors){
                    console.log(key);
                }
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
            change: function () {
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
