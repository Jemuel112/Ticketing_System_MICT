<template>
    <div>
        <!--        <div class="wrapper">-->
        <side-bar></side-bar>
<!--        <div class="content-wrapper">-->
<!--            <section class="content">-->
                <transition name="right" mode="out-in">
                    <router-view name="content"></router-view>
                </transition>
<!--            </section>-->
<!--        </div>-->
        <!--        </div>-->
        <transition name="right" mode="out-in">
            <router-view name="footer"></router-view>
        </transition>
    </div>
</template>

<script>
    export default {
        name: 'App',
        data() {
            return {}
        }
    }
</script>

<style scoped>
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
