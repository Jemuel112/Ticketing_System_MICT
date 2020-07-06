<template>
    <v-app>
        <v-navigation-drawer
            app
            :permanent="$vuetify.breakpoint.mdOnly"
            :temporary="$vuetify.breakpoint.smAndDown"
            :mini-variant="drawer"
            :expand-on-hover="drawer"
        >
            <v-list dense>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Home</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>mdi-email</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Contact</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar
            app
            color="indigo"
            dark
        >
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>Application</v-toolbar-title>
        </v-app-bar>

        <v-main>
            <v-container
                class="fill-height"
                fluid
            >
                <v-row
                    align="center"
                    justify="center"
                >
                    <v-col class="text-center">
                        <v-tooltip left>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    :href="source"
                                    icon
                                    large
                                    target="_blank"
                                    v-on="on"
                                >
                                    <v-icon large>mdi-code-tags</v-icon>
                                </v-btn>
                            </template>
                            <span>Source</span>
                        </v-tooltip>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
        <v-footer
            color="indigo"
            app
        >
            <span class="white--text">&copy; {{ new Date().getFullYear() }}</span>
        </v-footer>
    </v-app>

    <!-- <div> -->
        <!--        <div class="wrapper">-->
        <!-- <side-bar></side-bar> -->
<!--        <div class="content-wrapper">-->
<!--            <section class="content">-->
                <!-- <transition name="right" mode="out-in"> -->
                    <!-- <router-view name="content"></router-view> -->
                <!-- </transition> -->
<!--            </section>-->
<!--        </div>-->
        <!--        </div>-->
        <!-- <transition name="right" mode="out-in"> -->
            <!-- <router-view name="footer"></router-view> -->
        <!-- </transition> -->
<!--     </div> -->

</template>

<script>
    export default {
        props: {
            source: String,
        },
        data: () => ({
            drawer: null,
        }),
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
