<template>

    <i :class="['fas', toggleStatus]" :style=""></i>

</template>

<script>
    export default {
        props: {
            status: {
                required: true,
                type: Boolean
            },
        },
        data() {
            return {
                switchClass: '',
                switchStyle: '',
            }
        },
        computed: {
            toggleStatus() {
                return this.switchClass = this.status === true ? 'fa-toggle-on' : 'fa-toggle-off'
            }
        }
    }
</script>

<style scoped>
    i {
        font-size: 2.3em;
    }
    .fa-toggle-on {
        color: #00acac;
    }
    .fa-toggle-off {
        color: grey;
    }

</style>