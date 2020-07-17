<template>
    <v-dialog v-model="dialog" max-width="800px">
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                v-bind="attrs"
                v-on="on"
                icon
            >
                <v-icon>mdi-square-edit-outline</v-icon>
            </v-btn>
        </template>
        <v-card>
            <v-toolbar flat color="primary" dark>
                <v-toolbar-title>Змінити адресу доставки</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-icon>mdi-content-save</v-icon>
                </v-btn>
                <v-btn icon @click="dialog = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>

            </v-toolbar>
            <v-card-text>
                <v-combobox label="Введіть назву населеного пункту"></v-combobox>
                <v-tabs>
                    <v-tab>
                        Доставка кур'єром
                    </v-tab>
                    <v-tab>
                        Доставка Новою Пошою
                    </v-tab>
                    <v-tab-item>
                        <v-row>
                            <v-col md="4">
                                <v-text-field label="Вулиця"></v-text-field>
                            </v-col>
                            <v-col md="4">
                                <v-text-field label="Будинок"></v-text-field>
                            </v-col>
                            <v-col md="4">
                                <v-text-field label="Квартира"></v-text-field>
                            </v-col>
                        </v-row>
                    </v-tab-item>
                    <v-tab-item>
                        <v-combobox label="Введіть відділення Нової Пошти"></v-combobox>
                    </v-tab-item>
                </v-tabs>
                <v-text-field label="Вартість доставки"></v-text-field>
            </v-card-text>
        </v-card>

    </v-dialog>
</template>

<script>
    export default {
        name: "CreateOrderDialog",
        data: () => ({
            valid: true,
            dialog: false,

            isLoading: false,
        }),
        watch: {

        }
    }
</script>

<style scoped>

</style>
