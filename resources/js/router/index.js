import Vue from 'vue'
import VueRouter from 'vue-router'


import Test from '../components/SoundNotification.vue'

Vue.use(VueRouter)

// export default new Router({
//     history: true,
//     routes:[
//         {
//             path: '/sample',
//             name: 'Test',
//             component: Test
//         }
//     ]
// })
const routes = [
    {
        path: '/sample',
        name: "Test",
        component: Test
    }
]

const router = new VueRouter({
    mode: "history",
    routes
})

export default router;
