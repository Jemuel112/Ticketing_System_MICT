<template>
    <div>
        <div class="wrapper">
            <side-bar></side-bar>
            <div class="content-wrapper">
                <section class="content">
                    <!--                    <link href="https://cdn.jsdelivr.net/npm/animate.css@3.5.1" rel="stylesheet" type="text/css">-->

                    <div>
                        <button @click="show = !show">
                            Toggle render
                        </button>
                        <transition
                            name="custom-classes-transition"
                            enter-active-class="animated tada"
                            leave-active-class="animated bounceOutRight"
                        >
                            <p v-if="show">hello</p>
                        </transition>
                    </div>
                    <!--                    <transition enter-active-class="animated fadeInRight " leave-active-class="animated fadeOutRight" mode="out-in">-->
                    <transition name="right" mode="out-in" key="1">
                        <router-view></router-view>
                    </transition>
                    <p>Sample Text</p>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'App',
        data() {
            return {
                show: true
            }
        }
    }
</script>

<style>
    .fade-enter-active {
        transform: translate(100%, 0);
        /*transition: opacity 1s ease;*/
        /*opacity: 100;*/
    }

    .fade-leave {
    }

    .fade-leave-active {
        transform: translate(-100%, 0);
        /*transition: opacity 1s ease;*/
        /*opacity: 0;*/
    }


    .right-enter-active, .right-leave-active {
        transition: 0.3s;
    }

    .right-enter, .right-leave-to {
        opacity: 0;
        transform: translate3d(10px, 0, 0);
    }

    .right-move {
        opacity: 0.5;
        transition: 0.5s;
    }
</style>
