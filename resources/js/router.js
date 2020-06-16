import Vue from 'vue'
import VueRouter from 'vue-router'

import Test from './components/SoundNotification.vue'

Vue.use(VueRouter)

const  router = new VueRouter({
    routes:[
        {
            path: '/sample',
            component: Test
        }
    ]
})
export default router
