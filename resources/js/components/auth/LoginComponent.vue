<template>
    <div class="coupon-accordion">
        <!-- ACCORDION START -->
        <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
        <div id="checkout-login" class="coupon-content">
            <div class="coupon-info">
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
                <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed
                    est sitametipsum luctus.</p>

                <form action="/login" method="post" @submit.prevent="login()">
                    <p class="form-row-first">
                        <label>Username or email <span class="required">*</span></label>
                        <input type="text" name="email" v-model="auth_email">
                    </p>
                    <p class="form-row-last">
                        <label>Password <span class="required">*</span></label>
                        <input type="password" name="password" v-model="auth_password">
                    </p>
                    <p class="form-row">
                        <input type="submit" value="Login"/>
                    </p>
                    <p class="lost-password">
                        <a href="#">Lost your password?</a>
                    </p>
                </form>
            </div>
        </div>
        <!-- ACCORDION END -->
    </div>
</template>

<script>
    export default {
        name: "LoginComponent",
        data() {
            return {
                //login
                auth_email: '',
                auth_password: '',
                success: null,
                error: null,
                message: ''
            }
        },
        methods: {
            login() {
                this.$store.dispatch('retrieveToken', {
                    email: this.auth_email,
                    password: this.auth_password,
                }).then(response => {
                    this.success = true;
                    this.error = false;
                    this.message = 'Авторизація пройшла успішно';
                    this.$emit('changeStatus', true) // подія
                }).catch(error => {
                    this.success = false;
                    this.error = true;
                    this.message = 'Помилка авторизації';
                    this.$emit('changeStatus', false) // подія
                })

            },
        }
    }
</script>

<style scoped>

</style>
