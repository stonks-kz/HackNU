<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
                        <h3></h3>
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
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        <option selected value="3">Other</option>
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
                "name" : this.user.name,
                "age" : document.getElementById("age"),
                "gender" : document.getElementById("gender")
            }
            console.log(req)
        }
    }
}
</script>

<style scoped>

</style>
