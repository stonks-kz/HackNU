<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="password">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <div class="btn btn-primary" v-on:click="login">
                                        Login
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
    name: "login",
    methods : {
        login: function (event){
            let email = document.getElementById("email").value
            let password = document.getElementById("password").value
            let req = {
                "email" : email,
                "password" : password
            }

            axios.post("http://127.0.0.1:8000/api/login", req)
                .then(response => {
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
