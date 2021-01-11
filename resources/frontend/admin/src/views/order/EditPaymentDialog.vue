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
                <v-toolbar-title>Змінити статус оплати</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-icon>mdi-content-save</v-icon>
                </v-btn>
                <v-btn icon @click="dialog = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>

            </v-toolbar>
            <v-card-text>
                <v-radio-group v-model="methodPay">
                    <template v-slot:label>
                        <div>Спосіб оплати</div>
                    </template>
                    <v-radio value="receipt" label="Оплата при отриманні замовлення"></v-radio>
                    <v-radio value="google-pay" label="Google Pay"></v-radio>
                    <v-radio value="card" label="Оплата карткою Visa/Mastercard"></v-radio>
                </v-radio-group>
                <v-radio-group v-model="paid">
                    <template v-slot:label>
                        <div>Оплата</div>
                    </template>
                    <v-radio value="1" label="Оплачено"></v-radio>
                    <v-radio value="0" label="Не оплачено"></v-radio>
                </v-radio-group>
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


            methodPay: null,
            paid: null,
        }),
        watch: {

        }
    }
</script>

<style scoped>

</style>
