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
        <audio autoplay>
            <source src='Google_Event-1.mp3' type="audio/mpeg">
        </audio>
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
                user: [],

            }
        },


        created() {
            axios.get('/api/user')
                .then((response) => {
                    this.user = response.data
                    // fname: response.data.fname,
                    // dept: response.data.department,
                    // this.dept = response.data.department
                });
            axios.get('/api/mTickets')
                .then((response) => {
                    this.newMT = response.data.new
                    this.activeMT = response.data.active
                })
                .catch(function (error) {
                    console.log(error)
                })

        },
        mounted() {
            this.listen()

        },
        updated() {

            console.log(this.newMT)

        },
        destroyed() {
          console.log('destroy')
        },

        computed: {
            fname: function () {
                return this.user.fname
            },
            dept: function () {
                return this.user.department
            }
        },

        methods: {
            log1() {
                console.log('log1')
            },

            log2() {
                console.log('log2')
            },

            // getAuthUser() {
            //     axios.get('/api/user')
            //         .then((response) => {
            //             this.user = response.data
            //             // fname: response.data.fname,
            //             // dept: response.data.department,
            //             // this.dept = response.data.department
            //         })
            // },

            // getMTicketCount() {
            //     axios.get('/api/mTickets')
            //         .then((response) => {
            //             this.newMT = response.data.new
            //             this.activeMT = response.data.active
            //         })
            //         .catch(function (error) {
            //             console.log(error)
            //         })
            // },

            listen() {
                Echo.channel('counter')
                    .listen('MTicket', (e) => {
                        console.log('test')
                        this.getMTicketCount()
                    })
            },

            playNotificationSound() {
                // const audio = new Howl({
                //     src: ['http://soundbible.com/mp3/Elevator Ding-SoundBible.com-685385892.mp3'],
                // });
                // var sad = new Audio('http://soundbible.com/mp3/Elevator Ding-SoundBible.com-685385892.mp3');
                console.log(this.user.id)
                if (this.activeMT) {
                    console.log('test1')
                }
                // setTimeout(() => {
                //     console.log('sound');
                //     },2000);

            },

        },

    }
</script>

<style scoped>

</style>
