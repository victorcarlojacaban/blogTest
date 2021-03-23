<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#">Blog App</router-link>
                <div class="collapse navbar-collapse">
                    <div class="navbar-nav">
                        <router-link exact-active-class="active" to="/blogs" class="nav-item nav-link">Blogs</router-link>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container mt-5">
            <div id="app">
                <div class="row">
                    <div class="col-12" v-if="blogs.length > 0">
                        <Post v-for="(post, key) in blogs" :post="post" :key="key">
                         </Post>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import Post from './Post.vue';
export default {
    name: 'App',
    components: {
        Post,
    },
    data() {
        return {
            blogs: [],
        };
    },
    mounted(){
        this.getBlogs()
    },
    methods:{
        getBlogs() {
            axios.get('/api/blogs').then(response=>{
                this.blogs = response.data;
            }).catch(error=>{
                console.log(error)
                this.blogs = []
            })
        }
    },
};
</script>

<style lang="scss">
$t-s: 12px;
$t-m: 14px;
$t-l: 18px;
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #000;
    padding: 24px;
    font-size: 14px;
}
h4 {
    font-size: 18px;
    margin: 0 0 8px 0;
    font-weight: 500;
}
p {
    margin-bottom: 0 !important;
}
a {
    cursor: pointer;
    color: #888;
    display: block;
}
</style>