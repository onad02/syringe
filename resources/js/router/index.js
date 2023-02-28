import { createWebHistory, createRouter } from 'vue-router'
import store from '@/store'


/* Layouts */
const Layout = () => import('@/components/layouts/Default.vue')
/* Layouts */

/* Guest Component */
const Login = () => import('@/components/Login.vue')
const Register = () => import('@/components/Register.vue')
const HomePage = () => import('@/components/HomePage.vue')
const MerchantInquiry = () => import('@/components/MerchantInquiry.vue')
const AgencyInquiry = () => import('@/components/AgencyInquiry.vue')
/* Guest Component */

/* Authenticated Component */
const Dashboard = () => import('@/components/Dashboard.vue')
/* Authenticated Component */

const routes =  [
    {
        path: '/',
        name: 'layout',
        component: Layout,
        meta: {
            middleware: "guest",
            title: `The Syringe`
        },
        children: [
            {
                name: "home",
                path: "/",
                component: HomePage,
                meta: {
                    middleware: "guest",
                    title: `The Syringe`
                }
            },
            {
                name: "merchant-inquiry",
                path: "/merchant-inquiry",
                component: MerchantInquiry,
                meta: {
                    middleware: "guest",
                    title: `Merchant Inquiry`
                }
            },
            {
                name: "agency-inquiry",
                path: "/agency-inquiry",
                component: AgencyInquiry,
                meta: {
                    middleware: "guest",
                    title: `Agency Inquiry`
                }
            },
            {
                name: "login",
                path: "/login",
                component: Login,
                meta: {
                    middleware: "guest",
                    title: `Login`
                }
            },
            {
                name: "register",
                path: "/register",
                component: Register,
                meta: {
                    middleware: "guest",
                    title: `Register`
                }
            },
            {
                name: "dashboard",
                path: "/dashboard",
                component: Dashboard,
                meta: {
                    middleware: "auth",
                    title: `Dashboard`
                }
            },
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    // if (to.meta.middleware == "guest") {
    //     if (store.state.auth.authenticated) {
    //         next({ name: "dashboard" })
    //     }
    //     next()
    // } else {
    //     if (store.state.auth.authenticated) {
    //         next()
    //     } else {
    //         next({ name: "login" })
    //     }
    // }
    next()
})

export default router