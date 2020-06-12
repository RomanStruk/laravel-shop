<template>
    <v-app id="inspire">
        <v-main>
            <v-container
                class="fill-height"
                fluid
            >
                <v-row
                    align="center"
                    justify="center"
                >
                    <v-col
                        cols="12"
                        sm="8"
                        md="4"
                    >
                        <v-card class="elevation-12">
                            <v-toolbar
                                color="primary"
                                dark
                                flat
                            >
                                <v-toolbar-title>Login form</v-toolbar-title>
                                <v-spacer></v-spacer>
                            </v-toolbar>
                            <v-card-text>
                                <v-alert v-if="error" type="error">
                                    {{message}}
                                </v-alert>
                                <v-form>
                                    <v-text-field
                                        label="Login"
                                        name="login"
                                        prepend-icon="mdi-account"
                                        type="text"
                                        v-model="auth_email"
                                    ></v-text-field>

                                    <v-text-field
                                        id="password"
                                        label="Password"
                                        name="password"
                                        prepend-icon="mdi-lock"
                                        type="password"
                                        v-model="auth_password"
                                    ></v-text-field>
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" @click="login">Login</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
    export default {
        name: "Login",
        props: {
            source: String,
        },
        data() {
            return {
                //login
                auth_email: '',
                auth_password: '',
                error: null,
                message: ''
            }
        },
        methods:{
            login() {
                this.$store.dispatch('retrieveToken', {
                    email: this.auth_email,
                    password: this.auth_password,
                }).then(response => {
                    this.$router.push('/dashboard');
                    console.log(response)
                    this.error = false;
                }).catch(error => {
                    this.error = true;
                    this.message = error.response.data.message;
                })

            },
        }
    }
</script>

<style scoped>

</style>
