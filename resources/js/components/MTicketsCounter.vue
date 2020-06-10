<template>
    <div>
        <p>{{fname}}</p>
        <h1 v-if='fname === "Jemuel"'>sample</h1>
        <h2 v-else>you're not Jemuel</h2>
        <h2 v-if='dept === "Administrator"'>you're an Administrator</h2>
        <h2 v-else>Not Administrator</h2>
        <span> <b>New Ticket:</b> {{newMT}}</span>
        <br>
        <span> <b>Active Ticket:</b> {{activeMT}}</span>
        <button @click="playNotificationSound">Check</button>
    </div>
</template>

<script>
    export default {
        name: "mtickets-counter",
        data() {
            return {
                isNew: '',
                isActive: '',
                newMT: '',
                activeMT: '',
                user:[],

            }},

        mounted() {
            this.getMTicketCount()
            this.getAuthUser()
            this.listen()

        },
        created() {
            setInterval(() => {
                if (this.activeMT) this.log2();
                if (this.newMT) this.log1();
            }, 5000)
        },
        computed:{
            fname: function(){
                return this.user.fname
            },
            dept: function () {
                return this.user.department
            }
        },

        methods: {
            log1(){
                console.log('log1')
            },

            log2(){
                console.log('log2')
            },

            getAuthUser() {
                axios.get('/api/user')
                    .then((response) => {
                        this.user = response.data
                            // fname: response.data.fname,
                            // dept: response.data.department,
                        // this.dept = response.data.department
                    })
            },

            getMTicketCount() {
                axios.get('/api/mTickets')
                    .then((response) => {
                        this.newMT = response.data.new
                        this.activeMT = response.data.active
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            },

            listen() {
                Echo.channel('counter')
                    .listen('MTicket', (e) => {
                        console.log('test')
                        this.getMTicketCount()
                    })
            },

            playNotificationSound() {
                console.log(this.newMT)
                console.log(this.activeMT)

            },

        },

    }
</script>

<style scoped>

</style>
