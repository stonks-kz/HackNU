<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <router-link style="text-align: left" class="text-align" :to="{ name: 'getUser', params: {id: user_id } }">{{user_name}}</router-link>
                    </div>
                    <div class="card-body p-3">
                        <h5 class="card-title">{{post_data.title}}</h5>
                        <p class="card-text ">{{ post_data.text }}</p>
                        <p class="likeDislike d-flex align-items-center justify-content-end">
                            {{post_data.like}} <svg v-on:click="likePost(post_data.id)" id="color" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512"><path d="m11.466 22.776c.141.144.333.224.534.224s.393-.08.534-.224l9.594-9.721c4.001-4.053 1.158-11.055-4.532-11.055-3.417 0-4.985 2.511-5.596 2.98-.614-.471-2.172-2.98-5.596-2.98-5.672 0-8.55 6.984-4.531 11.055z" fill="#f44336"/></svg>
                            &nbsp;
                            {{post_data.dislike}} <svg v-on:click="dlikePost(post_data.id)" id="regular" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512"><path d="m22.25 0h-2.5c-.965 0-1.75.785-1.75 1.75v.366c-1.512-.77-4.946-2.116-10.531-2.116h-1.6c-2.319 0-4.286 1.658-4.68 3.942l-1.12 6.5c-.238 1.387.145 2.797 1.049 3.871.904 1.072 2.228 1.687 3.631 1.687h4.536c-.283.76-.566 1.868-.566 3.25 0 3.757 2.126 4.75 3.25 4.75 2.076 0 2.25-1.936 2.25-3.75 0-2.214 2.483-4.054 3.794-4.872.067.904.816 1.622 1.737 1.622h2.5c.965 0 1.75-.785 1.75-1.75v-13.5c0-.965-.785-1.75-1.75-1.75zm-9.531 20.25c0 2.25-.381 2.25-.75 2.25-.704 0-1.75-.866-1.75-3.25 0-2.216.868-3.574.874-3.584.153-.23.168-.526.037-.77-.13-.244-.385-.396-.661-.396h-5.72c-.96 0-1.865-.42-2.483-1.153-.619-.734-.881-1.7-.718-2.649l1.12-6.5c.269-1.564 1.615-2.698 3.201-2.698h1.6c6.803 0 10.211 2.128 10.531 2.339v9.81c-.833.442-5.281 2.972-5.281 6.601zm9.781-5c0 .138-.112.25-.25.25h-2.5c-.138 0-.25-.112-.25-.25v-13.5c0-.136.114-.25.25-.25h2.5c.138 0 .25.112.25.25z"/></svg>
                        </p>
                    </div>
                </div>
                <div id="comments" class="mt-3">
                    <input class="form-control mb-1" id="saveComment" type="textarea" placeholder="Comment">
                    <button class="btn btn-primary" v-on:click="saveComment">Add Comment</button>
                </div>
                <div class="col-md-10">
                    <div v-for="com in comments" class="mt-3">
                        <div class="card">
                            <div class="card-header">
                                <router-link :to="{name: 'getUser', params: {id: com.user_id }}">
                                    User
                                </router-link>
                            </div>
                            <div class="card-body">
                                <p>
                                    {{com.text}}
                                </p>
                                <p class="likeDislike d-flex align-items-center justify-content-end">
                                    {{com.like}} <svg v-on:click="likeComment(com.id)" id="color" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512"><path d="m11.466 22.776c.141.144.333.224.534.224s.393-.08.534-.224l9.594-9.721c4.001-4.053 1.158-11.055-4.532-11.055-3.417 0-4.985 2.511-5.596 2.98-.614-.471-2.172-2.98-5.596-2.98-5.672 0-8.55 6.984-4.531 11.055z" fill="#f44336"/></svg>
                                    &nbsp;
                                    {{com.dislike}} <svg v-on:click="dlikeComment(com.id)" id="regular" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512"><path d="m22.25 0h-2.5c-.965 0-1.75.785-1.75 1.75v.366c-1.512-.77-4.946-2.116-10.531-2.116h-1.6c-2.319 0-4.286 1.658-4.68 3.942l-1.12 6.5c-.238 1.387.145 2.797 1.049 3.871.904 1.072 2.228 1.687 3.631 1.687h4.536c-.283.76-.566 1.868-.566 3.25 0 3.757 2.126 4.75 3.25 4.75 2.076 0 2.25-1.936 2.25-3.75 0-2.214 2.483-4.054 3.794-4.872.067.904.816 1.622 1.737 1.622h2.5c.965 0 1.75-.785 1.75-1.75v-13.5c0-.965-.785-1.75-1.75-1.75zm-9.531 20.25c0 2.25-.381 2.25-.75 2.25-.704 0-1.75-.866-1.75-3.25 0-2.216.868-3.574.874-3.584.153-.23.168-.526.037-.77-.13-.244-.385-.396-.661-.396h-5.72c-.96 0-1.865-.42-2.483-1.153-.619-.734-.881-1.7-.718-2.649l1.12-6.5c.269-1.564 1.615-2.698 3.201-2.698h1.6c6.803 0 10.211 2.128 10.531 2.339v9.81c-.833.442-5.281 2.972-5.281 6.601zm9.781-5c0 .138-.112.25-.25.25h-2.5c-.138 0-.25-.112-.25-.25v-13.5c0-.136.114-.25.25-.25h2.5c.138 0 .25.112.25.25z"/></svg>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "showPost",
    props : [
        'id'
    ],
    data() {
        return {
            post_data: {},
            user_name: "",
            user_id: null,
            comments: [],
            names: []
        }
    },
    mounted() {

        axios.get("http://127.0.0.1:8000/api/getPostById/" + this.id)
            .then(response => {
                this.post_data = response.data[0].post
                this.user_name = response.data[0].user_name
                this.user_id = response.data[0].user_id
            })
            .catch(error => {
                alert("Error occured")
            })

        axios.get("http://127.0.0.1:8000/api/getComments/" + this.id)
            .then(response => {
                this.comments = response.data
            })
            .catch(error => {
                alert("Error occured")
            })
    },
    methods: {
        saveComment() {
            let req = {
                "user_id" : JSON.parse(localStorage.getItem("user")).id,
                "text" : document.getElementById('saveComment').value,
                "post_id" : this.post_data.id,
                "like" : 0,
                "dislike": 0
            }

            axios.post('http://127.0.0.1:8000/api/setComment/', req)
                .then(response => {
                })
                .catch(error => {
                    alert("error")
                })
        },
        likePost(){

        },
        dlikePost(){

        },
        likeComment(id){
            let req = {
                "id" : id
            }
            axios.post('http://127.0.0.1:8000/api/addLikeC/', req)
                .then(response => {
                    console.log(response)
                })
                .catch(error => {
                    alert("error")
                })
        },
        dlikeComment(id) {
            let req = {
                "id" : id
            }
            axios.post('http://127.0.0.1:8000/api/addDLikeC/', req)
                .then(response => {
                    console.log(response)
                })
                .catch(error => {
                    alert("error")
                })
        }
    }
}
</script>

<style scoped>
.likeDislike{
    text-align: right;
    margin-bottom: 0;
}
svg{
    cursor: pointer;
    width: 18px;
    height: 18px;
}
</style>
