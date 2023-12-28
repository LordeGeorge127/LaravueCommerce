import {createRouter, createWebHistory} from "vue-router";
import Login from "../views/Login.vue";
import Dashboard from "../views/Dashboard.vue";
import RequestPassword from "../views/RequestPassword.vue";
import ResetPassword from "../views/ResetPassword.vue";
import GuestLayout from "../components/GuestLayout.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/app',
            'name': 'dashboard',
            component: Dashboard,
            children:[
                {
                    path: 'dashboard',
                    name: 'app.dashboard',
                    component: GuestLayout
                },
            ]
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/request-password',
            name: 'requestPassword',
            component: RequestPassword
        } ,
        {
            path: '/reset-password/:token',
            name: 'resetPassword',
            component: ResetPassword
        }

    ]
})
export default router
