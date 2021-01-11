<template>
    <div>
        <h3>Контактні дані</h3>
        <div v-if="success === true" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5>Успіх!</h5>
            {{message}}
        </div>
        <div v-if="error === true" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5>Помилка!</h5>
            <ul>
                <li>{{ message }}</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="checkout-form-list">
                    <label for="full_name">Ім'я та прізвище <span class="required">*</span></label>
                    <input
                        id="full_name"
                        name="full_name"
                        type="text"
                        placeholder=""
                        v-model="full_name"
                        @blur="$v.full_name.$touch()"
                        :class="{'is-invalid': $v.full_name.$error}"
                    >
                    <div class="invalid-feedback" v-if="!$v.full_name.required">Поле обов'язкове до
                        заповнення
                    </div>
                    <div class="invalid-feedback" v-if="!$v.full_name.mustBeFullName">Вкажіть Ваше
                        Прізвище та Ім'я
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="checkout-form-list">
                    <label for="email" class="">Ел. пошта<span class="required">*</span></label>
                    <input
                        class="form-control"
                        id="email"
                        name="email"
                        type="email"
                        placeholder=""
                        v-model="email"
                        @blur="$v.email.$touch()"
                        :class="{'is-invalid': $v.email.$error}"
                    >
                    <div class="invalid-feedback" v-if="!$v.email.required">Поле обов'язкове до
                        заповнення
                    </div>
                    <div class="invalid-feedback" v-if="!$v.email.email">Вкажіть правильну
                        електронну пошту
                    </div>
                    <div class="invalid-feedback" v-if="!$v.email.unique">Електронна пошта вже
                        використовується
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="checkout-form-list mb-30">
                    <label for="phone">Мобільний телефон <span class="required">*</span></label>
                    <input
                        id="phone"
                        name="phone"
                        type="text"
                        placeholder=""
                        v-model="phone"
                        @blur="$v.phone.$touch()"
                        :class="{'is-invalid': $v.phone.$error}"
                    >
                    <div class="invalid-feedback" v-if="!$v.phone.required">Поле обов'язкове до
                        заповнення
                    </div>
                    <div class="invalid-feedback" v-if="!$v.phone.mustBePhone">Вкажіть правильний
                        номер телефону
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button
                    class="btn btn-primary float-right"
                    :disabled="$v.$invalid"
                    @click.prevent="submit"
                >Реєстрація</button>
            </div>
        </div>
    </div>
</template>

<script>
    import {email, requiredIf} from "vuelidate/lib/validators";
    const mustBePhone = (value) => {
        if (value === '') return true;
        return Boolean(value.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im));
    }
    const mustBeFullName = (value) => {
        if (value === '') return true;
        return Boolean(value.match(/^[a-zA-Zа-яА-Я]{2,50} [a-zA-Zа-яА-Я]{2,50}$/))
    };
    const mustBeUniqueEmail = (value) => {
        if (value === '') return true;
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                axios.get('/api/v1/validate/email/' + value).then((response) => {
                    resolve(!response.data.exists);
                }).catch(function (error) {
                    resolve(true);
                });

            }, 1000)
        });

    };
    export default {
        name: "FastRegisterComponent",
        data() {
            return {
                //user
                email: '',
                phone: '',
                full_name: '',
                success: null,
                error: null,
                message: ''
            }
        },
        validations: {
            email: {
                required: requiredIf(function (value) {
                    return !this.loggedIn
                }),
                email,
                unique: mustBeUniqueEmail
            },
            phone: {
                required: requiredIf(function (value) {
                    return !this.loggedIn
                }),
                mustBePhone
            },
            full_name: {
                required: requiredIf(function (value) {
                    return !this.loggedIn
                }),
                mustBeFullName
            },

        },
        computed: {
            loggedIn() {
                return this.$store.getters.loggedIn
            }
        },
        methods: {
            submit(){
                axios.post('/api/v1/fast-register', {
                    email: this.email,
                    full_name: this.full_name,
                    phone: this.phone,
                }).then((response) => {
                    console.log(response);                    // debug
                    this.success = true;
                    this.error = false;
                    this.message = 'Реєстрація пройшла успішно';

                    this.$store.commit('retrieveUser', response.data);
                    localStorage.setItem('access_token', response.data.access_token)
                    this.$store.commit('retrieveToken', response.data.access_token);

                    this.$emit('registered', true) // подія
                }).catch( (error) =>{
                    this.success = false;
                    this.error = true;
                    this.message = 'Помилка реєстрації';
                    this.$emit('registered', false) // подія
                    console.log(error);                       // debug error
                });

            }
        }
    }
</script>

<style scoped>

</style>
