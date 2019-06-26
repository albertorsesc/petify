<template>

    <div class="modal fade bd-example-modal-lg"
         :id="modalId"
         tabindex="-1"
         role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title"
                        v-text="options.title"
                    ></h4>

                    <button type="button" @click="close()" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <slot :name="options.body"></slot>

                </div>
                <div class="modal-footer">
                    <button type="button"
                            @click="close()"
                            class="btn btn-secondary btn-lg btn-block btn-rounded">
                        Cerrar
                    </button>
                    <button @click="submit()"
                            :class="[
                                'btn',
                                'btn-lg',
                                'btn-block',
                                'btn-rounded',
                                'text-white',
                                'mt-0',
                                options.btnClass
                            ]"
                            v-if="! options.hidden"
                            v-text="options.btnTitle">
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: {
            options: {
                type: Object,
                required: true,
            },
            modalId: {
                type: String,
                default: 'modal'
            }
        },
        methods: {
            submit() {
                Event.$emit('modal:submit')
            },
            open() {
                Event.$emit('modal:open')
            },
            close() {
                Event.$emit('modal:close')
            },
        },
    }
</script>