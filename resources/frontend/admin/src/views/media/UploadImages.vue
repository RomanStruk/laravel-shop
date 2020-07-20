<template>
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
                    v-if="bindToProduct"
                    label="Прикріпити до товару"
                    item-text="title"
                    item-value="product_id"
                ></v-select>
                <v-select
                    v-if="bindToProduct"
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
                                    :style="hover ? '': 'opacity: 0.7;'"
                                >
                                    <v-card-title class="title white--text">
                                        <v-row
                                            class="fill-height flex-column"
                                            justify="space-between"
                                            :style="hover ? 'background-color: rgba(0, 0, 255, 0.2);':''"
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
</template>

<script>
    export default {
        name: "UploadImages",
        data: () => ({
            valid: true,

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
        props:['bindToProduct']


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
