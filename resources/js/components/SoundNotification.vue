<template>
    <!--    @if($notify > 0)-->
    <!--    <audio autoplay>-->
    <!--        <source src="{{asset('Google_Event-1.mp3')}}" type="audio/mpeg">-->
    <!--    </audio>-->
    <!--    @elseif($myActive>0)-->
    <!--    <audio autoplay>-->
    <!--        <source src="{{asset('my_active_alarm.mp3')}}" type="audio/mpeg">-->
    <!--    </audio>-->
    <!--    @endif-->
    <div>
        <p>sample Text</p>
        <button class="btn btn-primary btn-sm"
                @click.prevent="playSound('http://soundbible.com/mp3/Elevator Ding-SoundBible.com-685385892.mp3')"><span
            class="fa fa-play-circle-o"></span>Play</button>
        <button class="btn btn-primary btn-sm"
                @click.prevent="playNotificationSound"><span
            class="fa fa-play-circle-o"></span>notification</button>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getUser();
        },
        data() {
            return {
                user: 'sample text',
                play: false,
                title: "sample",
            }
        },
        methods: {

            getUser() {
                axios.get('/api/user')
                    .then((response) => {
                        console.log(response.data)
                    })
            },

            playSound(sound) {
                if (sound) {
                    var audio = new Audio(sound);
                    audio.play();
                }
            },

            playNotificationSound() {
                console.log('demo');
                var myTrack = new Audio('Google_Event-1.mp3')
                setTimeout(() => {if(this.play)  myTrack.play();}, 2000);
                this.play =! this.play

            },

        },
    }
</script>
