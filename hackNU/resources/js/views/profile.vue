<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">
                        User Profile
                    </div>
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: left">
                            <b>{{ user.email }}</b>
                        </h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-action" id="personal">
                                <div v-on:click="show('personal','personalShow')">
                                    Personal Information
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mt-md-3" v-if="personalShow">
                                            <form method="POST" action="">
                                                <div class="form-group row">
                                                    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                                                    <div class="col-md-6">
                                                        <input :value="user.name" id="username" type="text" class="form-control" name="username" autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="age" class="col-md-4 col-form-label text-md-right">Age</label>
                                                    <div class="col-md-6">
                                                        <input :value="user.age" id="age" type="text" class="form-control" name="age">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                                                    <div class="col-md-6">
                                                        <select :value="user.gender" id="gender" class=" form-control form-select" aria-label="Default select example">
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option selected value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-8 offset-md-4">
                                                        <div class="btn btn-danger" v-on:click="saveChanges">
                                                            Save Changes
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action" id="current">
                                <div v-on:click="show('current','currentShow')">
                                    Current Issues
                                </div>
                                <div  v-if="currentShow" v-for="elem in data">
                                    <div class="card bg-light m-3 p-2" v-if="elem.status === 0 && elem.user_id === user.id">
                                        <div class="d-flex justify-content-between" style="height: 30px">
                                            <router-link :to="{ name: 'showPost', params: {id: elem.id } }">
                                                <div class=" float-md-left">{{ elem.title }}</div>
                                            </router-link>
                                            <p>{{elem["created_at"].slice(0, 16)}}</p>
                                        </div>

                                        <hr class="mt-1 mb-1">
                                        <div class="card-body">
                                            <p class="card-text float-md-left">{{ elem.text }}</p>
                                        </div>
                                        <p class="likeDislike d-flex align-items-center justify-content-end">
                                            {{elem.like}} <svg id="color" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512"><path d="m11.466 22.776c.141.144.333.224.534.224s.393-.08.534-.224l9.594-9.721c4.001-4.053 1.158-11.055-4.532-11.055-3.417 0-4.985 2.511-5.596 2.98-.614-.471-2.172-2.98-5.596-2.98-5.672 0-8.55 6.984-4.531 11.055z" fill="#f44336"/></svg>
                                            &nbsp;
                                            {{elem.dislike}} <svg id="regular" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512"><path d="m22.25 0h-2.5c-.965 0-1.75.785-1.75 1.75v.366c-1.512-.77-4.946-2.116-10.531-2.116h-1.6c-2.319 0-4.286 1.658-4.68 3.942l-1.12 6.5c-.238 1.387.145 2.797 1.049 3.871.904 1.072 2.228 1.687 3.631 1.687h4.536c-.283.76-.566 1.868-.566 3.25 0 3.757 2.126 4.75 3.25 4.75 2.076 0 2.25-1.936 2.25-3.75 0-2.214 2.483-4.054 3.794-4.872.067.904.816 1.622 1.737 1.622h2.5c.965 0 1.75-.785 1.75-1.75v-13.5c0-.965-.785-1.75-1.75-1.75zm-9.531 20.25c0 2.25-.381 2.25-.75 2.25-.704 0-1.75-.866-1.75-3.25 0-2.216.868-3.574.874-3.584.153-.23.168-.526.037-.77-.13-.244-.385-.396-.661-.396h-5.72c-.96 0-1.865-.42-2.483-1.153-.619-.734-.881-1.7-.718-2.649l1.12-6.5c.269-1.564 1.615-2.698 3.201-2.698h1.6c6.803 0 10.211 2.128 10.531 2.339v9.81c-.833.442-5.281 2.972-5.281 6.601zm9.781-5c0 .138-.112.25-.25.25h-2.5c-.138 0-.25-.112-.25-.25v-13.5c0-.136.114-.25.25-.25h2.5c.138 0 .25.112.25.25z"/></svg>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action" id="resolved">
                                <div v-on:click="show('resolved','resolvedShow')">
                                    Resolved Issues
                                </div>
                                <div v-if="resolvedShow" v-for="elem in data">
                                    <div class="card text-white bg-success" style="margin: 5%;" v-if="elem.status === 1 && elem.user_id === user.id">
                                        <router-link :to="{ name: 'showPost', params: {id: elem.id } }">
                                            <div class="card-header">{{ elem.title }}</div>
                                        </router-link>
                                        <div class="card-body">
                                            <p class="card-text">{{ elem.text }}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
<!--                            <li class="list-group-item list-group-item-action" id="assisted">-->
<!--                                <div v-on:click="show('assisted','assistedShow')">-->
<!--                                    Assisted Issues-->
<!--                                </div>-->
<!--                                <div class="card text-white bg-secondary" style="margin: 5%;" v-if="assistedShow">-->
<!--                                    <div class="card-header">Header</div>-->
<!--                                    <div class="card-body">-->
<!--                                        <h5 class="card-title">Dark card title</h5>-->
<!--                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "profile",
    data() {
        return {
            personalShow : false,
            resolvedShow : false,
            assistedShow : false,
            currentShow : false,
            user : {},
            data : null,
        }
    },
    mounted() {
        this.user = JSON.parse(localStorage.getItem("user"))
    },
    methods:{
        show(id, bool) {
            let status = null;

            if (bool === 'personalShow') {
                this.personalShow = !this.personalShow
            } else if (bool === 'currentShow') {
                this.currentShow = !this.currentShow
                status = 0
            // } else if (bool === 'assistedShow') {
            //     this.assistedShow = !this.assistedShow
            } else if (bool === 'resolvedShow') {
                this.resolvedShow = !this.resolvedShow
                status = 1
            }

            let classList = document.getElementById(id).classList
            if (!classList.contains('active')) {
                classList.add('active')
            } else {
                classList.remove('active')
            }

            if (status !== null) {
                axios.get("http://127.0.0.1:8000/api/profileGetPosts")
                    .then(response => {
                        this.data = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        },
        saveChanges() {
            let req = {
                "email" : this.user.email,
                "name" : document.getElementById('username').value,
                "age" : document.getElementById("age").value,
                "gender" : document.getElementById("gender").value,
            }
            axios.post("http://127.0.0.1:8000/api/profileChange", req)
                .then(response => {
                    let user = JSON.stringify(response.data[0])
                    localStorage.setItem("user", user)
                    this.$nextTick(() =>{
                        location.reload()
                    })
                })
                .catch(error => {
                    alert("Wrong data inserted")
                })
        },

    }
}
</script>

<style scoped>
    li{
        cursor: pointer;
    }
    svg{
        width: 18px;
        height: 18px;
    }
    .list-group-item-action{
        transition: 0.3s;
        transition-timing-function: ease-in-out;
    }
    p{
        color: #4c4c4c;
    }
    .likeDislike{
        text-align: right;
        margin-bottom: 0;
    }
</style>
