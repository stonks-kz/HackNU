<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create new post</div>
                    <div class="card-body">


                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Title</span>
                            <input type="text" class="form-control" id="title" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <button id="postCat" class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Choose categories</button>

                            <div class="d-flex justify-content-between w-100">
                                <div class="col w-100" >
                                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                                        <div class=" card-body flex-wrap d-flex justify-content-between w-100">
                                            <div v-for="tag in tags" role="group" aria-label="Basic radio toggle button group">
                                                <input hidden type="checkbox" class="check-with-label" :id="tag.id" />
                                                <label class="label-for-check badge btn btn-outline-primary post-label" :for="tag.id">{{tag.name}}</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-text">Post text</span>
                            <textarea id="textArea" class="form-control" aria-label="With textarea"></textarea>
                        </div>

                        <button v-on:click="addPost" type="button" class="float-md-right mt-3 btn btn-primary">Upload post</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
export default {
name: "addPost",
    data() {
        return{
            tags: [],
        }
    },
    mounted() {
        axios.get("http://127.0.0.1:8000/api/tagList")
            .then(response => {
                this.tags = response.data
            })
            .catch(error => {
                alert("Error occured")
                location.reload()
            })
    },
    methods: {
        addPost() {
            let tags = document.getElementsByClassName("check-with-label")
            let cats = []
            let i = 0
            for(const tag in tags){
                if(tags[tag].checked){
                    cats[i] = tags[tag].id
                    i++
                }
            }

            let req = {
                'text' : document.getElementById("textArea").value,
                'categories' : cats,
                'title' : document.getElementById("title").value,
                'user_id' : JSON.parse(localStorage.getItem("user")).id,
                'status' : 0,
                'like' : 0,
                'dislike' : 0,
            }
            console.log(req)
            axios.post("http://127.0.0.1:8000/api/addPost", req)
                .then(response => {
                    console.log(response)
                })
                .catch(error => {
                    alert("Error")
                })
        }

    }
}
</script>

<style scoped>
    #postCat:focus{
        box-shadow: none;
    }

    .check-with-label:checked + .label-for-check {
        background: #3490dc !important;
        color: white;

    }
    .label-for-check{
        font-size: 14px;
        margin-right: 20px;
    }
</style>
