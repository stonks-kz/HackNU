<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item" v-for="link in links">
                        <router-link class="nav-link" :to="link.href">{{link.title}}</router-link>
                    </li>
                </ul>
                <div v-if="user !== undefined && user !== '' ">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{user.name}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <router-link class="dropdown-item" v-for="dropLink in dropDownLinks" :to="dropLink.href">
                            {{dropLink.title}}
                        </router-link>
                        <a class="dropdown-item" v-on:click="logout">
                            Logout
                        </a>
                    </div>
                </div>
                <div v-else class="d-flex justify-content-between">
                    <router-link class="nav-link" :to="login">
                        Login
                    </router-link>
                    <router-link class="nav-link" :to="registration">
                        Register
                    </router-link>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: "vmain",
    data() {
        return {
            user : "",
            links: [
                {
                    title: "Main page",
                    href: "/"
                },
            ],
            dropDownLinks: [
                {
                    title: "Profile",
                    href: "/profile"
                },
                {
                    title: "Share Problem",
                    href: "/addPost"
                }
            ],
            login: "/login",
            registration: "/registration"
        }
    },
    mounted() {
        let usa = JSON.parse(localStorage.getItem("user"))
        if(usa){
            this.user = usa
        }
    },
    methods : {
        logout : function (event) {
            localStorage.clear()
            this.$nextTick(() =>{
                location.reload()
            })
            this.$router.push('/');
        },
    }
}
</script>

<style scoped>

</style>
