<template>
    <div class="card-body">
        <h5 class="card-title"><i>Comments</i></h5>
        <ul class="list-group list-group-flush" v-if="comments.length > 0">
            <li class="list-group-item" v-for="(comment,key) in comments" :key="key" v-if="comment.parent_id == null">
                <h6><i class="fa fa-user" aria-hidden="true"></i> {{ comment.commentor }}</h6>
                {{ comment.content }} 
                <i>{{ comment.readable_created_at }}</i>
                
                <ul class="list-group list-group-flush" v-if="comment.replies.length > 0">
                    <li class="list-group-item" v-for="(reply,key) in comment.replies" :key="key">
                    <h6><i class="fa fa-user" aria-hidden="true"></i> {{ reply.commentor }}</h6>
                    {{ reply.content }} <i>{{ reply.readable_created_at }}</i>
                        <ul class="list-group list-group-flush" v-if="reply.replies.length > 0">
                            <li class="list-group-item" v-for="(reply,key) in reply.replies" :key="key">
                                <h6><i class="fa fa-user" aria-hidden="true"></i> {{ reply.commentor }}</h6>
                                {{ reply.content }} <i>{{ reply.readable_created_at }}</i>
                            </li>
                        </ul>  
                    </li>
                </ul>  
            </li>
      </ul>
    </div>
</template>
<script>
    export default{
        name:"comment-list",
        props: ['comments'],
        computed:{
        }
    }
</script>