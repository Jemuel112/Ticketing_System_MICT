<template>
    <div>
        <div class="wrapper">
            <side-bar></side-bar>
            <transition name="fade" mode="out-in">
                <div class="content-wrapper">
                    <section class="content">

                        <router-view></router-view>
                    </section>
                </div>
            </transition>

        </div>
    </div>
</template>

<script>
    export default {
        name: 'App',
    }
</script>

<style>
    .fade-enter-active {
        transition: opacity 2s ease;
    }

    .fade-leave {}

    .fade-leave-active {
        transition: opacity 2s ease;
        opacity: 0;
    }
</style>
