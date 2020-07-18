<template>
    <div>
        <v-card>
            <v-img
                class="white--text align-end hidden-md-and-up"
                height="200px"
                sizes="sm"
                src="http://shop.test/storage/avatars/avatar-2.jpg"
            >
                <v-card-title>Roman Struk</v-card-title>
            </v-img>
            <v-card-title
                class="hidden-sm-and-down cyan darken-1 white--text"

            >

                <v-row>
                    <v-col>
                        <v-avatar
                            height="150px"
                            width="150px"
                        >
                            <v-img src="http://shop.test/storage/avatars/avatar-2.jpg"></v-img>
                        </v-avatar>
                    </v-col>
                    <v-col>
                        Roman Struk
                    </v-col>
                    <v-col>
                        $ 0
                        Всього замовив
                    </v-col>
                    <v-col>
                        5
                        Замовлень
                    </v-col>
                    <v-col class="d-flex justify-end">
                        <v-menu bottom left>
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                    dark
                                    icon
                                    v-bind="attrs"
                                    v-on="on"
                                >
                                    <v-icon>mdi-dots-vertical</v-icon>
                                </v-btn>
                            </template>

                            <v-list>
                                <v-list-item
                                    @click="dialogMain = true"
                                >
                                    <v-list-item-title>Змінити email, пароль</v-list-item-title>
                                </v-list-item>
                                <v-list-item
                                    @click="dialogDetail = true"
                                >
                                    <v-list-item-title>Оновити інформацію</v-list-item-title>
                                </v-list-item>
                                <v-list-item
                                    @click="dialogAvatar = true"
                                >
                                    <v-list-item-title>Змінити аватар</v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </v-col>
                </v-row>


            </v-card-title>
            <v-dialog v-model="dialogDetail" persistent max-width="600px">
                <v-card>
                    <v-card-title>
                        <span class="headline">Детальна інформація</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        label="Ім'я*"
                                        hint="example of persistent helper text"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        label="Прізвище*"
                                        hint="example of helper text only on focus"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field label="Телефон" hint="example of helper text only on focus"></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-autocomplete
                                        :items="['Україна', 'Ice hockey', 'Soccer', 'Basketball', 'Hockey', 'Reading', 'Writing', 'Coding', 'Basejump']"
                                        label="Країна"
                                    ></v-autocomplete>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-menu
                                        v-model="datePickerMenu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        transition="scale-transition"
                                        offset-y
                                        min-width="290px"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="birthdayDate"
                                                label="Дата народження"
                                                prepend-icon="mdi-calendar"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker v-model="birthdayDate" @input="datePickerMenu = false"></v-date-picker>
                                    </v-menu>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field label="Адреса" hint="example of helper text only on focus"></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                        <small>*indicates required field</small>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="dialogDetail = false">Close</v-btn>
                        <v-btn color="blue darken-1" text @click="dialogDetail = false">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialogMain" persistent max-width="600px">
                <v-card>
                    <v-card-title>
                        <span class="headline">Основна інформація</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field label="Email*" hint="example of helper text only on focus" required></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field label="Новий пароль*" type="password" required></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field label="Повторіть пароль*" type="password" required></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                        <small>*indicates required field</small>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="dialogMain = false">Close</v-btn>
                        <v-btn color="blue darken-1" text @click="dialogMain = false">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialogAvatar" persistent max-width="600px">
                <v-card>
                    <v-card-title>
                        <span class="headline">Аватар</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="6">
                                    <v-avatar
                                        height="150px"
                                        width="150px"
                                    >
                                        <v-img src="http://shop.test/storage/avatars/avatar-2.jpg"></v-img>
                                    </v-avatar>
                                </v-col>
                                <v-col cols="6">
                                    <v-file-input
                                        prepend-icon="mdi-image-filter-center-focus-strong-outline"
                                        label="Завантажити світлину"
                                        hint="Зображення не більше 400х400px"
                                    ></v-file-input>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="dialogAvatar = false">Close</v-btn>
                        <v-btn color="blue darken-1" text @click="dialogAvatar = false">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>

            <v-card-text>
                <v-row>
                    <v-col xs="12" sm="12" md="4" xl="2" lg="2">
                        <v-list disabled>
                            <v-subheader>
                                <v-icon class="mr-2">mdi-information-variant</v-icon>
                                Детальна інформація
                            </v-subheader>
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-title>
                                        <div class="my-2"><b class="grey--text">Full Name :</b> Roman Struk</div>
                                        <div class="my-2"><b class="grey--text">Mobile :</b> +12345678901</div>
                                        <div class="my-2"><b class="grey--text">Email :</b> admin@gmail.com</div>
                                        <div class="my-2"><b class="grey--text">Country :</b> Ukraine</div>
                                        <div class="my-2"><b class="grey--text">Location :</b> Some address</div>
                                        <div class="my-2"><b class="grey--text">Birthday :</b> 1993-05-28</div>
                                        <div class="my-2"><b class="grey--text">Реєстрація :</b>1993-05-28</div>
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-col>
                    <v-col xs="12" sm="12" md="8" xl="5" lg="5">
                        <v-list disabled>
                            <v-subheader>
                                <v-icon class="mr-2">mdi-credit-card-outline</v-icon>
                                Замовлення (останні 5)
                            </v-subheader>
                            <v-list-item>
                                <v-list-item-content>
                                    <v-data-table
                                        :headers="headers"
                                        :items="desserts"
                                        :items-per-page="5"

                                        hide-default-footer
                                    ></v-data-table>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-col>
                    <v-col xs="12" sm="12" md="12" xl="5" lg="5">
                        <v-row >
                            <v-subheader>
                                <v-icon class="mr-2">mdi-comment-text-multiple-outline</v-icon>
                                Коментарі
                            </v-subheader>

                            <v-expansion-panels popout>
                                <v-expansion-panel
                                    v-for="(message, i) in messages"
                                    :key="i"
                                    hide-actions
                                >
                                    <v-expansion-panel-header>
                                        <v-row
                                            align="center"
                                            class="spacer"
                                            no-gutters
                                        >
                                            <v-col
                                                cols="4"
                                                sm="2"
                                                md="1"
                                            >
                                                <v-avatar
                                                    color="teal"
                                                    size="36px"
                                                >
                                                    <span class="white--text headline">RS</span>
                                                </v-avatar>
                                            </v-col>

                                            <v-col
                                                class="hidden-xs-only"
                                                sm="5"
                                                md="3"
                                            >
                                                <strong v-html="message.name"></strong>
                                            </v-col>

                                            <v-col
                                                class="text-no-wrap"
                                                cols="5"
                                                sm="3"
                                            >
                                                <v-chip
                                                    v-if="message.new"
                                                    :color="`${message.color} lighten-4`"
                                                    class="ml-0 mr-2 black--text"
                                                    label
                                                    small
                                                >
                                                    {{ message.new }}
                                                </v-chip>
                                                <strong v-html="message.title"></strong>
                                            </v-col>

                                        </v-row>
                                    </v-expansion-panel-header>

                                    <v-expansion-panel-content>
                                        <v-divider></v-divider>
                                        <v-card-text v-text="lorem"></v-card-text>
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                            </v-expansion-panels>
                        </v-row>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
    export default {
        name: "ShowUser",
        data() {
            return {
                dialog: false,

                dialogDetail: false,
                datePickerMenu:false,
                birthdayDate:null,

                dialogMain: false,
                dialogAvatar: false,


                headers: [
                    {
                        text: '#',
                        align: 'start',
                        sortable: false,
                        value: 'calories',
                    },
                    {text: 'Коментар', value: 'name'},
                    {text: 'Сума (грн)', value: 'fat'},
                    {text: 'Дата', value: 'carbs'},
                ],
                desserts: [
                    {
                        name: 'Frozen Yogurt',
                        calories: 159,
                        fat: 6.0,
                        carbs: 24,
                        protein: 4.0,
                        iron: '1%',
                    },
                    {
                        name: 'Ice cream sandwich',
                        calories: 237,
                        fat: 9.0,
                        carbs: 37,
                        protein: 4.3,
                        iron: '1%',
                    },
                    {
                        name: 'Eclair',
                        calories: 262,
                        fat: 16.0,
                        carbs: 23,
                        protein: 6.0,
                        iron: '7%',
                    },
                    {
                        name: 'Cupcake',
                        calories: 305,
                        fat: 3.7,
                        carbs: 67,
                        protein: 4.3,
                        iron: '8%',
                    },
                    {
                        name: 'Gingerbread',
                        calories: 356,
                        fat: 16.0,
                        carbs: 49,
                        protein: 3.9,
                        iron: '16%',
                    },
                    {
                        name: 'Jelly bean',
                        calories: 375,
                        fat: 0.0,
                        carbs: 94,
                        protein: 0.0,
                        iron: '0%',
                    },
                    {
                        name: 'Lollipop',
                        calories: 392,
                        fat: 0.2,
                        carbs: 98,
                        protein: 0,
                        iron: '2%',
                    },
                    {
                        name: 'Honeycomb',
                        calories: 408,
                        fat: 3.2,
                        carbs: 87,
                        protein: 6.5,
                        iron: '45%',
                    },
                    {
                        name: 'Donut',
                        calories: 452,
                        fat: 25.0,
                        carbs: 51,
                        protein: 4.9,
                        iron: '22%',
                    },
                    {
                        name: 'KitKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        iron: '6%',
                    },
                ],
                messages: [
                    {
                        avatar: 'https://avatars0.githubusercontent.com/u/9064066?v=4&s=460',
                        name: 'RomanStruk',
                        title: 'Casio MRP-700-1 AVEFKXF - Касио МРП 700',
                        excerpt: 'Thank you for joining our community...',
                    },
                    {
                        color: 'red',
                        icon: 'people',
                        name: 'RomanStruk',
                        new: 1,
                        total: 3,
                        title: 'Twitter',
                    },
                    {
                        color: 'teal',
                        icon: 'local_offer',
                        name: 'RomanStruk',
                        new: 2,
                        total: 4,
                        title: 'Shop your way',
                        exceprt: 'New deals available, Join Today',
                    },
                ],
                lorem: 'Lorem ipsum dolor sit amet, at aliquam vivendum vel, everti delicatissimi cu eos. Dico iuvaret debitis mel an, et cum zril menandri. Eum in consul legimus accusam. Ea dico abhorreant duo, quo illum minimum incorrupte no, nostro voluptaria sea eu. Suas eligendi ius at, at nemore equidem est. Sed in error hendrerit, in consul constituam cum.',
            }
        },
    }
</script>

<style scoped>

</style>
