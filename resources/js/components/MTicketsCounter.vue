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
                fname: "",
                dept: "",
            }
        },

        mounted() {
            this.getMTicketCount()
            this.getAuthUser()
            this.listen()

        },

        methods: {
            getAuthUser() {
                axios.get('/api/user')
                    .then((response) => {
                        this.fname = response.data.fname
                        this.dept = response.data.department
                    })
                    .catch(function (error) {
                        console.log(error)
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
