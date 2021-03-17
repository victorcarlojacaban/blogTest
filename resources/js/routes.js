const BlogList = () => import('./components/blog/List.vue')

export const routes = [
    {
        name: 'blogList',
        path: '/blogs',
        component: BlogList
    },
]