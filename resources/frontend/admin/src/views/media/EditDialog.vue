<template>
    <v-dialog v-model="dialog" max-width="1000px">
        <v-card>

            <v-toolbar flat color="primary" dark>
                <v-toolbar-title>Редагувати</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-icon>mdi-content-save</v-icon>
                </v-btn>
                <v-btn icon @click="dialog = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>

            </v-toolbar>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="6">
                            <v-text-field
                                label="Назва"
                                :value="imageItem.title"
                            ></v-text-field>
                            <v-text-field
                                label="Ключові слова"
                                :rules="[v => !!v || 'Item is required']"
                            ></v-text-field>
                            <v-text-field
                                label="Опис"
                                :rules="[v => !!v || 'Item is required']"
                            ></v-text-field>
                            <v-select
                                label="Прикріпити до товару"
                                item-text="title"
                                item-value="product_id"
                            ></v-select>
                            <v-select
                                label="Видимість"
                            ></v-select>
                        </v-col>
                        <v-col cols="6">

                            <v-img
                                :src="`https://picsum.photos/500/300?image=15`"
                                :lazy-src="`https://picsum.photos/10/6?image=15`"
                                aspect-ratio="1"
                                class="grey lighten-2"
                            >
                                <template v-slot:placeholder>
                                    <v-row
                                        class="fill-height ma-0"
                                        align="center"
                                        justify="center"
                                    >
                                        <v-progress-circular indeterminate
                                                             color="grey lighten-5"></v-progress-circular>
                                    </v-row>
                                </template>
                            </v-img>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "CreateDialog",
        data: () => ({
            valid: true,
            dialog: false,

            isLoading: false,
        }),
        props:['imageItem', 'editDialog'],
        watch:{
            editDialog: {
                handler(){
                    this.dialog = this.editDialog
                }
            }
        }


    }
</script>

<style scoped>

</style>
