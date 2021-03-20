<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registration</div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="Username" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirm" class="col-md-4 col-form-label text-md-right">Confirm password</label>
                                <div class="col-md-6">
                                    <input v-on:keyup.enter="register" id="password_confirm" type="password" class="form-control" name="password_confirm" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <div class="btn btn-primary" v-on:click="register">
                                        Register
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
    name: "registration",
    methods: {
        register(){
            let req = {
                "email" : document.getElementById("email").value,
                "name" : document.getElementById("username").value,
                "password" : document.getElementById("password").value,
                "password_confirm" : document.getElementById("password_confirm").value,
            }
            axios.post("http://127.0.0.1:8000/api/registration", req)
                .then(response => {
                    console.log(response)
                    let user = JSON.stringify(response.data[0])
                    localStorage.setItem("user", user)
                    this.$nextTick(() =>{
                        location.reload()
                    })
                    this.$router.push('/');
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
