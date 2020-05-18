import VueRouter from "vue-router";
import Vue from "vue";
import Login from "./components/auth/Login";
import NotFound from "./components/NotFound";
import Dashboard from "./components/dashboard/Dashboard.vue";
import store from "./store/store";

Vue.use(VueRouter);

// const metaGuest = {}

const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard

        },
        {
            path: '*',
            component: NotFound
        }
    ]
});

router.beforeEach((to, from, next) => {

    if (to.name !== 'login' && store.state.authenticated) {
        next()
    } else {
        next()
    }

});

export default router;
