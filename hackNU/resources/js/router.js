import vueRouter from 'vue-router'
import Vue from 'vue'

Vue.use(vueRouter)

import mainPage from "./views/mainPage";
import registration from "./views/registration";
import login from "./views/login";
import profile from "./views/profile";
import addPost from "./views/addPost";
const routes = [
    {
        path: "/",
        component: mainPage
    },
    {
        path: "/registration",
        component: registration
    },
    {
        path: "/login",
        component: login
    },
    {
        path: "/addPost",
        component: addPost
    },
    {
        path: "/profile",
        component: profile
    },
]

export default new vueRouter({
    mode: "history",
    routes: routes
})
