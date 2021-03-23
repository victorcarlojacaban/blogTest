<template>
    <div class="comment">
        <div class="d-flex align-items-center">
            <Avatar :text="comment.commentor" size="30"></Avatar>
            <div class="ml-2">
                <strong>{{ comment.commentor }}</strong>
                <p>{{ comment.content }}</p>
                <p>{{ comment.readable_created_at }}</p>
            </div>
        </div>
         <a class="d-flex align-items-center text-muted ml-1" @click="$set(comment, 'expanded', true)" v-if="comment.replies && !comment.expanded && comment.depth <= 3">
            <i class="material-icons"></i> {{ comment.replies.length }} replies:
        </a>
        <div v-if="comment.replies && comment.expanded">
            <a class="d-flex align-items-center text-muted ml-1" @click="$set(comment, 'expanded', false)">
                Close
            </a>

            <Comment v-for="(comment, key) in comment.replies" :comment="comment" :key="key"></Comment>

            <div v-if="comment.depth <= 3">
                <div v-if="errors" class="alert alert-danger shadow-lg">
                  <div v-for="(v, k) in errors" :key="k">
                    <p v-for="error in v" :key="error" class="text-sm" >
                      {{ error }}
                    </p>
                  </div>
                </div>
                <h6 class="card-title">Reply</h6>
                <form @submit.prevent="replyComment(comment.id)">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label>Commentor name</label>
                                <input type="text" class="form-control" v-model="commentData.commentor">
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label>Content</label>
                                <textarea
                                  id="e-textarea"
                                  class="form-control"
                                  row="3"
                                 v-model="commentData.content"
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
        </div>
    </div>
</template>


<script>
import Avatar from './Avatar';
import Comment from './Comment';
export default {
    name: 'Comment',
    data(){
        return {
            commentData:{
                content:"",
                commentor:"",
            },
            errors: null
        }
    },
    props: {
        comment: {
            type: Object,
            required: true,
        }
    },
    components: { Avatar, Comment },
    methods:{
        replyComment(commentId) {
            this.commentData.parent_id = commentId;
            axios.post('/api/create_comment',this.commentData).then(response=> {
                this.comment.replies.push({
                    id: response.data.id,
                    content: response.data.content,
                    commentor: response.data.commentor,
                    readable_created_at: response.data.readable_created_at,
                    depth: response.data.depth + 1,
                    expanded: false,
                    replies: response.data.replies
                });

                this.commentData = {
                    content: '',
                    commentor: '',
                };
                this.errors = null;
            }).catch(error=>{
                console.log(error);
                this.errors = error.response.data.errors;
            });
        }
    }
};
</script>

<style lang="scss" scoped>
.comment {
    padding: 16px;
    margin: 16px 0 0 16px;
    border: 1px solid #e9e9e9;
    border-radius: 4px;
}
</style>