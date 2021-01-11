<template>
    <v-card>
        <v-card-title>Додати користувача</v-card-title>
        <v-card-text>
            <v-form
                v-model="valid"
                lazy-validation
            >
                <v-text-field
                    prepend-icon="mdi-email"
                    label="Email"
                ></v-text-field>
                <v-text-field
                    prepend-icon="mdi-form-textbox-password"
                    label="Новий пароль"
                ></v-text-field>
                <v-text-field
                    prepend-icon="mdi-form-textbox-password"
                    label="Повторити пароль"
                ></v-text-field>
                <v-text-field
                    prepend-icon="mdi-form-textbox"
                    label="Ім'я"
                ></v-text-field>
                <v-text-field
                    prepend-icon="mdi-form-textbox"
                    label="Прізвище"
                ></v-text-field>
                <v-text-field
                    prepend-icon="mdi-cellphone"
                    label="Телефон"
                ></v-text-field>
                <v-file-input
                    label="Avatar"
                ></v-file-input>
                <v-text-field
                    prepend-icon="mdi-ski-cross-country"
                    label="Країна"
                ></v-text-field>
                <v-text-field
                    prepend-icon="mdi-home-city-outline"
                    label="Адреса"
                ></v-text-field>
                <v-menu
                    ref="menu"
                    v-model="calendar"
                    :close-on-content-click="false"
                    :return-value.sync="date"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="date"
                            label="Дата народження"
                            prepend-icon="mdi-calendar"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker v-model="date" no-title scrollable>
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="calendar = false">Cancel</v-btn>
                        <v-btn text color="primary" @click="$refs.menu.save(date)">OK</v-btn>
                    </v-date-picker>
                </v-menu>

            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-btn
                color="blue"
                dark
            >
                save
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
    export default {
        name: "CreateUser",
        data () {
            return {
                valid:true,
                calendar: false,
                date:null
            }
        }
    }
</script>

<style scoped>

</style>
