<template>
    <div>
        <section class="jumbotron text-center">
            <h1>Latest Posts</h1>
            <div class="album py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4" v-for="elem in posts">
                            <div class="card text-center" style="margin: 4% 0;">
                                <router-link :to="{ name: 'showPost', params: {id: elem.id } }">
                                    <div class="card-header">{{ elem.title }}</div>
                                </router-link>
                                <div class="card-body">
                                    <p class="card-text">{{ elem.text }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: "mainPage",
    data() {
        return {
            posts : {},
            user : null
        }
    },
    created() {
        this.user = JSON.parse(localStorage.getItem("user"))
        axios.get("http://127.0.0.1:8000/api/getAllPosts")
            .then(response => {
                console.log(response)
                this.posts = response.data
            })
            .catch(error => {
                console.log(error)
            })
    }
}
</script>

<style scoped>

</style>
