import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from "../views/Login";
import Template from "../views/Template";

Vue.use(VueRouter)

import store from '../store' // your vuex store

const ifNotAuthenticated = (to, from, next) => {
    if (!store.getters.loggedIn) {
        next()
        return
    }
    next('/')
}

const ifAuthenticated = (to, from, next) => {
    if (store.getters.loggedIn) {
        next()
        return
    }
    next('/login')
}
const routes = [
    {
        path: '/login',
        name: 'Auth',
        component: Login,
        beforeEnter: ifNotAuthenticated,

    },
    {
        path: '/logout',
        name: 'Logout',
        component: Login,
        beforeEnter: ifNotAuthenticated,

    },
    {
        path: '/',
        name: 'Template',
        redirect: '/dashboard',
        component: Template,
        beforeEnter: ifAuthenticated,
        children: [
            {
                path: '/dashboard',
                component: () => import(/* webpackChunkName: "dashboard" */ '../views/Dashboard.vue')
            }
        ]
    },
    {
        path: '/order/',
        name: 'admin.order.index',
        component: Template,
        beforeEnter: ifAuthenticated,
        children: [
            {
                path: '/order/index',
                component: () => import(/* webpackChunkName: "order.index" */ '../views/order/Index.vue')
            },
            {
                path: '/order/show',
                component: () => import(/* webpackChunkName: "order.show" */ '../views/order/Show.vue')
            }
        ]
    },
    {
        path: '/order/print',
        name: 'admin.order.print',
        component: () => import(/* webpackChunkName: "order.show" */ '../views/order/PrintOrder.vue'),
        beforeEnter: ifAuthenticated,
    },
    {
        path: '/category/',
        name: 'admin.category.index',
        component: Template,
        beforeEnter: ifAuthenticated,
        children: [
            {
                path: '/category/index',
                component: () => import(/* webpackChunkName: "category.index" */ '../views/category/Index.vue')
            },
        ]
    },
    {
        path: '/product/',
        name: 'admin.product.index',
        component: Template,
        beforeEnter: ifAuthenticated,
        children: [
            {
                path: '/product/index',
                component: () => import(/* webpackChunkName: "product.index" */ '../views/product/Index.vue')
            },
        ]
    },
    {
        path: '/user/',
        name: 'admin.user.index',
        component: Template,
        beforeEnter: ifAuthenticated,
        children: [
            {
                path: '/user/index',
                component: () => import(/* webpackChunkName: "user.index" */ '../views/user/Index.vue')
            },
        ]
    },
    {
        path: '/media/',
        name: 'admin.media.index',
        component: Template,
        beforeEnter: ifAuthenticated,
        children: [
            {
                path: '/media/index',
                component: () => import(/* webpackChunkName: "media.index" */ '../views/media/Index.vue')
            },
        ]
    },
    {
        path: '/filter/',
        name: 'admin.filter.index',
        component: Template,
        beforeEnter: ifAuthenticated,
        children: [
            {
                path: '/filter/index',
                component: () => import(/* webpackChunkName: "filter.index" */ '../views/filter/Index.vue')
            },
        ]
    },
    {
        path: '/supplier/',
        name: 'admin.supplier.index',
        component: Template,
        beforeEnter: ifAuthenticated,
        children: [
            {
                path: '/supplier/index',
                component: () => import(/* webpackChunkName: "supplier.index" */ '../views/supplier/Index.vue')
            },
        ]
    },
    {
        path: '/syllable/',
        name: 'admin.syllable.index',
        component: Template,
        beforeEnter: ifAuthenticated,
        children: [
            {
                path: '/syllable/index',
                component: () => import(/* webpackChunkName: "syllable.index" */ '../views/syllable/Index.vue')
            },
        ]
    },
    {
        path: '/about',
        name: 'About',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
    }
]

const router = new VueRouter({
    mode: 'history',
    base: '/admin-panel/',
    routes
})

export default router
