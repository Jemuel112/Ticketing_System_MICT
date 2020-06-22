<template>
    <div>
        <div class="wrapper">
            <side-bar></side-bar>
            <div class="content-wrapper">
                <router-view></router-view>
            </div>.


        </div>
    </div>
</template>

<script>
    export default {
        name: 'App',
    }
</script>
