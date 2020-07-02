import Vue from 'vue'
import VueRouter from 'vue-router'


import Test from '../components/SoundNotification.vue'

import Test2 from '../components/MTicketsCounter'

import Footer from '../components/layouts/Footer.vue'
import FooterMTickets from "../components/layouts/FooterMTickets.vue"

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
        components: {content: Test, footer: Footer}
    },
    {
        path: '/',
        name: "Passport",
        components: {content: Test2, footer: FooterMTickets}
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
