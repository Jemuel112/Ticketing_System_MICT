<template>
    <footer class="main-footer">
        <div id="ver">

            <div class="float-right">
                <b>Version</b> {{ version }}
                <button type="submit"style="margin-left: 10px" class="btn btn-primary"><i
                    class="nav-icon fal fa-plus-circle"></i>
                    Submit
                </button>

            </div>
            <strong>Copyright &copy; {{ year }} <a href="https://www.mcuhospital.org/">MCU Hospital</a>.</strong> All
            rights
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
