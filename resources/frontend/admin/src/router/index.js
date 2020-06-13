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
                component: () => import(/* webpackChunkName: "order.index" */ '../views/Order/Index.vue')
            },
            {
                path: '/order/show',
                component: () => import(/* webpackChunkName: "order.show" */ '../views/Order/Show.vue')
            }
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
