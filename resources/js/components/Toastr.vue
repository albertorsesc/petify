<template></template>

<script>

    import Toastr from '../models/Toastr'

    export default {
        props: {
            message: {
                type: String,
            }
        },
        created() {
            if (this.message) {
                this.flash(this.message)
                Event.$on('flash', message => this.flash(message));
            }
        },
        methods: {
            flash(message) {
                Toastr.login(message)
            },
        },
    }
</script>