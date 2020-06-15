<template>
    <v-app id="sandbox">

        <v-snackbar
            v-model="snake.snackStatus"
            :color="snake.snackColor"
            multi-line
            right
            top
        >
            {{snake.snackText}}
            <template v-slot:action="{ attrs }">
                <v-btn
                    dark
                    text
                    v-bind="attrs"
                    @click="snake.snackStatus=false"
                >Close</v-btn>
            </template>
        </v-snackbar>

        <v-navigation-drawer
            v-model="primaryDrawer.model"
            :clipped="primaryDrawer.clipped"
            :floating="primaryDrawer.floating"
            :mini-variant="primaryDrawer.mini"
            :permanent="primaryDrawer.type === 'permanent'"
            :temporary="primaryDrawer.type === 'temporary'"
            app
            overflow

        >
            <template v-slot:prepend>
                <v-list-item two-line>
                    <v-list-item-avatar>
                        <img src="https://randomuser.me/api/portraits/women/81.jpg">
                    </v-list-item-avatar>

                    <v-list-item-content>
                        <v-list-item-title>Jane Smith</v-list-item-title>
                        <v-list-item-subtitle>Logged In</v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-action>
                        <v-btn icon @click="logout">
                            <v-icon>{{svgPath.mdiLogoutVariant }}</v-icon>
                        </v-btn>
                    </v-list-item-action>
                </v-list-item>
            </template>

            <v-divider></v-divider>
            <v-list nav dense>
                <v-list-group
                    v-for="item in menuItems"
                    :key="item.title"
                    v-model="item.active"
                    :prepend-icon="item.icon"
                    no-action
                >
                    <template v-slot:activator>
                        <v-list-item-content>
                            <v-list-item-title v-text="item.title"></v-list-item-title>
                        </v-list-item-content>
                    </template>
                    <v-list-item
                        v-for="subItem in item.items"
                        :key="subItem.title"
                        :to="subItem.action"
                    >
                        <v-list-item-content>
                            <v-list-item-title v-text="subItem.title"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-group>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar
            :clipped-left="primaryDrawer.clipped"
            app
            extended
            hide-on-scroll
        >
            <v-app-bar-nav-icon
                v-if="primaryDrawer.type !== 'permanent'"
                @click.stop="primaryDrawer.model = !primaryDrawer.model"
            ></v-app-bar-nav-icon>

            <v-autocomplete
                v-model="model"
                :items="itemsSearch"
                :loading="isLoading"
                :search-input.sync="search"
                hide-details
                hide-no-data
                hide-selected
                item-text="title"
                item-value="id"
                class="ml-5"

                label="Start typing to Search"
                append-icon="mdi-magnify"
                solo
                return-object
            ></v-autocomplete>

            <v-spacer></v-spacer>
            <ChatMenuBar></ChatMenuBar>
            <NotificationMenuBar></NotificationMenuBar>

            <template v-slot:extension>
                <v-toolbar-title>Shop</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-breadcrumbs :items="breadcrumbs">
                    <template v-slot:divider>
                        <v-icon>mdi-chevron-right</v-icon>
                    </template>
                </v-breadcrumbs>
            </template>
        </v-app-bar>

        <v-main>
            <v-container fluid>
                <v-layout row>

                </v-layout>

                <router-view></router-view>
            </v-container>
        </v-main>

        <v-footer
            :inset="true"
            app
        >
            <span class="px-4">&copy; {{ new Date().getFullYear() }} Roman Struk</span>
        </v-footer>
    </v-app>
</template>

<script>

    import {
        mdiLogoutVariant, mdiMonitorDashboard, mdiCamcorder, mdiFilter, mdiFolderMultipleImage, mdiViewList,
        mdiBasket, mdiAccountMultiple
    } from '@mdi/js'
    import NotificationMenuBar from "../components/NotificationMenuBar";
    import ChatMenuBar from "../components/ChatMenuBar";

    export default {
        name: "Template",
        components: {ChatMenuBar, NotificationMenuBar},
        data: () => ({
            descriptionLimit: 60,
            entries: [],
            isLoading: false,
            model: null,
            search: null,

            snackbarError: false,
            snackbarSuccess: false,

            breadcrumbs: [
                {
                    text: 'Dashboard',
                    disabled: false,
                    href: 'breadcrumbs_dashboard',
                }, {
                    text: 'Link 1',
                    disabled: false,
                    href: 'breadcrumbs_link_1',
                }, {
                    text: 'Link 2',
                    disabled: true,
                    href: 'breadcrumbs_link_2',
                },
            ],

            svgPath: {mdiLogoutVariant}, // import icons

            primaryDrawer: {
                model: null,
                type: 'default (no property)',
                clipped: false,
                floating: false,
                mini: false,
            },
            //menus
            menuItems: [
                {
                    title: 'Dashboard ',
                    icon: mdiMonitorDashboard,
                    active: true,
                    items: [
                        {
                            title: 'Dashboard ',
                            action: '/dashboard'
                        },
                    ],
                },
                {
                    title: 'Замовленя',
                    icon: mdiCamcorder,
                    items: [
                        {title: 'Огляд', action: '/order/index'},
                        {title: 'Додати', action: '/order/create'},
                    ],
                },
                {
                    title: 'Категорії',
                    icon: mdiViewList,
                    items: [
                        {title: 'Огляд', action: '/category/index'},
                        {title: 'Додати', action: '/category/create'},
                    ],
                },
                {
                    title: 'Товари',
                    icon: mdiBasket,
                    items: [
                        {title: 'Огляд', action: '/product/index'},
                        {title: 'Додати', action: '/product/create'},
                        {title: 'Постачальники', action: '/supplier/index'},
                        {title: 'Склад', action: '/syllable/index'},
                    ],
                },
                {
                    title: 'Користувачі',
                    icon: mdiAccountMultiple,
                    items: [
                        {title: 'Огляд', action: '/user/index'},
                        {title: 'Додати', action: '/user/create'},
                    ],
                },
                {
                    title: 'Медіа',
                    icon: mdiFolderMultipleImage,
                    items: [
                        {title: 'Огляд', action: '/media/index'},
                        {title: 'Додати', action: '/media/create'},
                    ],
                },
                {
                    title: 'Фільтри',
                    icon: mdiFilter,
                    items: [
                        {title: 'Огляд', action: '/filter/index'},
                        {title: 'Додати', action: '/filter/create'},
                    ],
                },
            ]
        }),
        computed: {
            snake:{
                get(){
                    return this.$store.state.snake;
                },
                set(){
                    this.$store.commit('SNAKE_BAR', {snackStatus:false})
                }
            },
            fields() {
                if (!this.model) return []

                return Object.keys(this.model).map(key => {
                    return {
                        key,
                        value: this.model[key] || 'n/a',
                    }
                })
            },
            itemsSearch() {
                return this.entries.map(entry => {
                    const title = entry.title.length > this.descriptionLimit
                        ? entry.title.slice(0, this.descriptionLimit) + '...'
                        : entry.title
                    return Object.assign({}, entry, {title})
                })
            },
        },
        watch: {
            search(val) {
                // Items have already been loaded
                // if (this.itemsSearch.length > 0) return

                // Items have already been requested
                if (this.isLoading) return

                this.isLoading = true

                this.$http.get('/search/products?q=' + val)
                    .then(res => res.data)
                    .then(res => {
                        const {count, data} = res
                        this.count = count
                        this.entries = data
                    })
                    .catch(err => {
                        console.log(err)
                    })
                    .finally(() => (this.isLoading = false))
            },
        },
        methods: {
            logout: function () {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/login')
                    })
            },
        }
    }
</script>

<style scoped>

</style>
