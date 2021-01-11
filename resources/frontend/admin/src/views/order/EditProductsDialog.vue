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
                <v-toolbar-title>Змінити товари</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-icon>mdi-content-save</v-icon>
                </v-btn>
                <v-btn icon @click="dialog = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>

            </v-toolbar>
            <v-card-text>
                <v-row class="px-6 py-3" align="center">
                    <v-col
                        v-for="(selection, i) in selected"
                        :key="selection.text"
                        class="shrink"
                    >

                        <v-menu
                            bottom
                            right
                            transition="scale-transition"
                            origin="top left"
                        >
                            <template v-slot:activator="{ on }">
                                <v-chip
                                    pill
                                    v-on="on"
                                    :disabled="isLoading"
                                    close
                                    @click:close="selected.splice(i, 1)"
                                >
                                    {{ selection.text }}
                                </v-chip>
                            </template>
                            <v-card width="300">
                                <v-list color="info" dark>
                                    <v-list-item>
                                        <v-list-item-avatar>
                                            <v-img
                                                src="https://cdn.vuetifyjs.com/images/john.png"></v-img>
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-list-item-title>Casio MQ-24-7</v-list-item-title>
                                            <v-list-item-subtitle>Одежда, обувь и аксессуары
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                        <v-list-item-action>
                                            <v-btn
                                                icon
                                                @click="selected.splice(i, 1)"
                                            >
                                                <v-icon>mdi-close-circle</v-icon>
                                            </v-btn>
                                        </v-list-item-action>
                                    </v-list-item>
                                </v-list>
                                <v-list>
                                    <v-list-item @click="() => {}">
                                        <v-list-item-action>
                                            <v-icon>mdi-package-variant-closed</v-icon>
                                        </v-list-item-action>
                                        <v-list-item-subtitle>Постачальник
                                        </v-list-item-subtitle>
                                    </v-list-item>
                                    <v-list-item @click="() => {}">
                                        <v-list-item-action>
                                            <v-icon>mdi-playlist-plus</v-icon>
                                        </v-list-item-action>
                                        <v-list-item-subtitle>5 шт</v-list-item-subtitle>
                                    </v-list-item>
                                </v-list>
                            </v-card>
                        </v-menu>
                    </v-col>
                </v-row>
                <v-row align-content="center">
                    <v-col cols="12" md="4">
                        <v-combobox
                            label="Товар"
                            item-value="id"
                            item-text="title"
                            :search-input.sync="searchProducts"
                            :items="products"
                            :rules="[v => !!v || 'Item is required']"
                            return-object
                            v-model="selectedProduct"
                            :loading="isLoading"
                        ></v-combobox>
                    </v-col>

                    <v-col cols="12" md="3">
                        <v-select
                            label="Постачальник"
                            item-value="id"
                            item-text="text"
                            :items="selectedProduct.syllables"
                            :rules="[v => !!v || 'Item is required']"
                        ></v-select>
                    </v-col>

                    <v-col cols="12" md="3">
                        <v-text-field label="Кількість товарів"></v-text-field>
                    </v-col>

                    <v-col cols="12" md="1">
                        <v-btn color="primary" icon>
                            <v-icon>mdi-plus-circle</v-icon>
                        </v-btn>
                    </v-col>
                </v-row>
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

            selected: [
                {
                    text: 'Android Watch BQ-1',
                    icon: 'mdi-map-marker',
                },
                {
                    text: 'Citizen AT0696-59E',
                    icon: 'mdi-bike',
                }
            ],
            selectedProduct: {id:null, title:null, syllables:[]},
            products: [],
            search: null,
            searchProducts: null,
        }),
        watch: {

        }
    }
</script>

<style scoped>

</style>
