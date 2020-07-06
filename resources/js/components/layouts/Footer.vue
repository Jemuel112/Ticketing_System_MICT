<template>
    <footer class="main-footer">
        <div id="ver">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> {{ version }}
            </div>
            <strong>Copyright &copy; {{ year }} <a href="https://www.mcuhospital.org/">MCU
                Hospital</a>.</strong>
            All rights
            reserved.
        </div>
    </footer>
</template>

<script>
    export default {
        data() {
            return {
                version: "0.1.0 (Beta)",
                year: new Date().getFullYear() + " MICT Department",
            }
        }
    }
</script>
