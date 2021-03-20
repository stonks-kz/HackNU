<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
                        <h3>{{user.email}}</h3>
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
                                    <div class="btn btn-primary" v-on:click="saveChanges">
                                        Save Changes
                                    </div>
                                </div>
                            </div>
                        </form>
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
            user : {}
        }
    },
    mounted() {
        this.user = JSON.parse(localStorage.getItem("user"))
    },
    methods:{
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
        }
    }
}
</script>

<style scoped>

</style>
