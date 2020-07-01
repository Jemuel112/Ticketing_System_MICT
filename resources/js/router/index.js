import Vue from 'vue'
import VueRouter from 'vue-router'


import Test from '../components/SoundNotification.vue'

import Test2 from '../components/ExampleComponent.vue'

//MTickets Components
import MCreateTicket from '../components/MTickets/Create.vue'



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
    },
    {
        path: '/',
        name: "Passport",
        component: Test2
    },
    {
      path: '/MICT'
    },


]

const router = new VueRouter({
    mode: "history",
    routes
})

export default router;
