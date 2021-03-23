<template>
        <div class="post">
            <div class="d-flex align-items-center">
                <h4>{{ post.title }}</h4>
            </div>
            <div class="d-flex align-items-center">
                <img
                    src="https://mdbootstrap.com/img/new/standard/city/062.jpg"
                    class="card-img-top"
                    height="300px"
                    alt="..."
                />
            </div>
            <div class="d-flex align-items-center">
                <h3>{{ post.description }}</h3>
            </div>
            <div class="card-body">
            <div v-if="errors" class="alert alert-danger shadow-lg">
              <div v-for="(v, k) in errors" :key="k">
                <p v-for="error in v" :key="error" class="text-sm" >
                  {{ error }}
                </p>
              </div>
            </div>
            <h5 class="card-title">Add comments</h5>
              <form @submit.prevent="postComment(post.id)">
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>                        
             </form>
         </div>
            <div class="post-summary">
                 <Comment v-for="(comment, key) in comments" :comment="comment" :key="key"></Comment>
            </div>
        </div>
</template>

<script>
import Comment from './Comment';
import {eventBus} from "./../app.js";
export default {
    name: 'Post',
    data(){
        return {
            comments: [],
            comment:{
                content:"",
                commentor:"",
                blog_id: ""
            },
            errors: null
        }
    },
    props: {
        post: {
            type: Object,
            required: true,
        },
    },
    mounted(){
        this.getComments()
    },
    created() {
        eventBus.$on('getComments', () => {
            this.getComments();
        })
    },
    components: {Comment},
    methods:{
        getComments() {
            axios.get('/api/getCommentsByBlogId/' + this.post.id).then(response=>{
                this.comments = response.data;
            }).catch(error=>{
                console.log(error)
                this.comments = []
            })
        },
        postComment(blogId) {
            this.comment.blog_id = blogId;
            axios.post('/api/create_comment',this.comment).then(response=> {
                this.getComments()
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
};
</script>

<style lang="scss" scoped>
.post {
    padding: 16px;
    margin-bottom: 16px;
    &-summary {
        padding-bottom: 16px;
        margin-left: 56px;
        color: #0e5bd2;
        font-weight: 500;
        border-bottom: 1px solid #e9e9e9;
    }
}
</style>