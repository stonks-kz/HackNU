import vueRouter from 'vue-router'
import Vue from 'vue'

Vue.use(vueRouter)

import mainPage from "./views/mainPage";
import registration from "./views/registration";
import login from "./views/login";
import profile from "./views/profile";
import addPost from "./views/addPost";
import showPost from "./views/showPost";
const routes = [
    {
        path: "/",
        name: "mainPage",
        component: mainPage
    },
    {
        path: "/registration",
        name: "registration",
        component: registration
    },
    {
        path: "/login",
        name: "login",
        component: login
    },
    {
        path: "/addPost",
        name: "addPost",
        component: addPost
    },
    {
        path: "/profile",
        name: "profile",
        component: profile
    },
    {
        path: "/showPost/:id",
        name: "showPost",
        component: showPost,
        props: true
    },
]

export default new vueRouter({
    mode: "history",
    routes: routes
})
