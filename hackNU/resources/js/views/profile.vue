<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">
                        User Profile
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ user.email }}
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
                                    <div class="card text-white bg-dark" style="margin: 5%;" v-if="elem.status === 0 && elem.user_id === user.id">
                                        <router-link :to="{ name: 'showPost', params: {id: elem.id } }">
                                            <div class="card-header">{{ elem.title }}</div>
                                        </router-link>
                                        <div class="card-body">
                                            <p class="card-text">{{ elem.text }}</p>
                                        </div>
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

</style>
