<template>
    <div class="row">
        <div class="col-12" v-if="blogs.length > 0">
            <div class="card" v-for="(blog,key) in blogs" :key="key">
              <img
                src="https://mdbootstrap.com/img/new/standard/city/062.jpg"
                class="card-img-top"
                height="300px"
                alt="..."
              />
              <div class="card-body">
                <h3 class="card-title">{{ blog.title }}</h3>
                <p class="card-text">
                  {{ blog.description }}
                </p>
              </div>
              <comment-list :comments="blog.comments"></comment-list>
              <div class="card-body">
                    <div v-if="errors" class="alert alert-danger shadow-lg">
                      <div v-for="(v, k) in errors" :key="k">
                        <p v-for="error in v" :key="error" class="text-sm" >
                          {{ error }}
                        </p>
                      </div>
                    </div>
                    <h5 class="card-title">Add comments</h5>
                      <form @submit.prevent="postComment(blog.id)">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Commentor name</label>
                                    <input type="text" class="form-control" v-model="comment.commentor">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea
                                      id="e-textarea"
                                      class="form-control"
                                      row="3"
                                     v-model="comment.content"
                                    >
                                    </textarea>

                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>                        
                     </form>
                 </div>
            </div>
        </div>
        <div class="col-12" v-else>
            <p>No blogs Found. Please run seeder for testing purposes.</p>
        </div>
    </div>
</template>

<script>
import CommentList from '../comment/CommentList.vue';
export default {
    name:"blogs",
    data(){
        return {
            blogs:[],
            comment:{
                content:"",
                commentor:"",
                blog_id: ""
            },
            errors: null
        }
    },
    mounted(){
        this.getBlogs()
    },
    components: {
        'comment-list': CommentList,
    },
    methods:{
        async getBlogs() {
            let vm = this;

            await this.axios.get('/api/blogs').then(response=>{
                this.blogs = response.data
            }).catch(error=>{
                console.log(error)
                this.blogs = []
            })
        },
        postComment(blogId) {
            this.comment.blog_id = blogId;
            axios.post('/api/create_comment',this.comment).then(response=> {
                this.getBlogs()
                this.comment = {
                    content: '',
                    commentor: '',
                };
                this.errors = null;
            }).catch(error=>{
                this.errors = error.response.data.errors;
            });
        }
    }
}
</script>