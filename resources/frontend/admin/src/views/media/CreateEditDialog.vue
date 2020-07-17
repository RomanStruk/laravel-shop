<template>
    <v-dialog v-model="dialog" max-width="1000px">
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="primary"
                dark
                v-bind="attrs"
                v-on="on"
                icon
            >
                <v-icon>mdi-plus-circle</v-icon>
            </v-btn>
        </template>
        <v-card>

            <v-toolbar flat color="primary" dark>
                <v-toolbar-title>Додати</v-toolbar-title>
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
                            <v-file-input
                                accept="image/png, image/jpeg, image/bmp"
                                placeholder="Виберіть зображення"
                                prepend-icon="mdi-camera"
                                label="Зображення"
                                multiple
                            ></v-file-input>
                            <v-progress-linear
                                :value="knowledge"
                                height="25"
                                stream
                            >
                                <strong>{{ Math.ceil(knowledge) }}% (2/6)</strong>
                            </v-progress-linear>
                            <v-row>
                                <v-col
                                    v-for="n in 9"
                                    :key="n"
                                    class="d-flex child-flex"
                                    cols="4"
                                >
                                    <v-hover v-slot:default="{ hover }">
                                        <v-card flat tile class="d-flex"
                                                :elevation="hover ? 12 : 2"
                                        >
                                            <v-img
                                                :src="`https://picsum.photos/500/300?image=${n * 5 + 10}`"
                                                :lazy-src="`https://picsum.photos/10/6?image=${n * 5 + 10}`"
                                                aspect-ratio="1"
                                                class="grey lighten-2"
                                                :style="hover ? 'opacity: 0.7;': ''"
                                            >
                                                <v-card-title class="title white--text">
                                                    <v-row
                                                        class="fill-height flex-column"
                                                        justify="space-between"
                                                    >

                                                        <div class="align-self-center">
                                                            <v-btn
                                                                :class="{ 'show-btns': hover }"
                                                                color="transparent"
                                                                icon
                                                            >
                                                                <v-icon
                                                                    :class="{ 'show-btns': hover }"
                                                                    color="transparent"
                                                                >mdi-arrow-up-bold
                                                                </v-icon>
                                                            </v-btn>
                                                            <v-btn
                                                                :class="{ 'show-btns': hover }"
                                                                color="transparent"
                                                                icon
                                                            >
                                                                <v-icon
                                                                    :class="{ 'show-delete-btn': hover }"
                                                                    color="transparent"
                                                                >mdi-delete
                                                                </v-icon>
                                                            </v-btn>
                                                            <v-btn :class="{ 'show-btns': hover }" color="transparent"
                                                                   icon>
                                                                <v-icon :class="{ 'show-btns': hover }"
                                                                        color="transparent">mdi-arrow-down-bold
                                                                </v-icon>
                                                            </v-btn>
                                                        </div>
                                                    </v-row>
                                                </v-card-title>

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
                                        </v-card>
                                    </v-hover>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "CreateEditDialog",
        data: () => ({
            valid: true,
            dialog: false,

            isLoading: false,

            file_rules: [
                value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
            ],

            skill: 20,
            knowledge: 33,
            power: 78,

            transparent: 'rgba(255, 255, 255, 0)',
            icons: ['mdi-rewind', 'mdi-play', 'mdi-fast-forward'],
        }),


    }
</script>

<style scoped>
    .show-btns {
        color: rgb(78, 155, 168) !important;
    }
    .show-delete-btn {
        color: rgb(236, 22, 22) !important;
    }
</style>
