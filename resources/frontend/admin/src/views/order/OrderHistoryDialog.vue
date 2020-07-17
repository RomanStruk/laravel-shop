<template>
    <v-dialog v-model="dialog" max-width="1000px">
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="blue"
                dark
                v-bind="attrs"
                v-on="on"
            >
                Змінити статус
                <v-icon class="ml-1">mdi-pencil</v-icon>
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span class="headline">Оновити статус замовлення</span>
            </v-card-title>

            <v-card-text>

                <v-form
                    ref="form"
                    v-model="valid"
                    lazy-validation
                >
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-select
                                    :items="order.available_list_status"
                                    v-model="statusHistory"
                                    label="Статус замовлення"
                                    :rules="[v => !!v || 'Item is required']"
                                ></v-select>
                            </v-col>
                            <v-col cols="12">
                                <v-switch v-model="sendEmail" label="Повідомити Замовника"></v-switch>
                            </v-col>
                            <v-col cols="12">
                                <v-textarea
                                    label="Коментар"
                                    v-model="comment"
                                    :rules="[v => !!v || 'Item is required']"
                                ></v-textarea>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="dialog = false">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="save" :disabled="!valid">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "OrderHistoryDialog",
        data: () => ({
            valid: true,
            dialog: false,

            isLoading: false,

            sendEmail: false,
            statusHistory: null,
            comment: null
        }),

        computed: {
            order: {
                get() {
                    return this.$store.state.apiLoadedData.data
                }
            }
        },
        methods: {
            validate() {
                this.$refs.form.validate()
            },

            save() {
                if (!this.$refs.form.validate()) return false;
                // some code that to save data
                this.dialog = false
                return true;
            }
        }
    }
</script>

