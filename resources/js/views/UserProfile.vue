<template>
    <div>

        <div class="row-fluid">

            <a href="/users"
               class="btn btn-primary text-white shadow-lg">
                Usuarios
            </a>
            <!--<a :href="`/me/${user.uuid}/properties`"
               class="btn btn-success text-white shadow-lg">
                mis Propiedades
            </a>-->

        </div>

        <hr>

        <div class="row">

            <div class="col-md-4 mb-2">
                <div class="card">
                    <img class="card-img-top" src="/user-placeholder.png" alt="avatar">
                    <div class="card-body text-center">
                        <button class="btn btn-info text-white btn-block shadow">
                            Actualizar imagen
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row">

                    <div class="col-md-6">
                        <div class="card mb-2 py-2 text-center">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item font-bold text-lg"
                                    v-text="user.fullName"
                                ></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-2 py-2 text-center">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item font-bold text-lg"
                                    v-text="user.userType.displayName"
                                ></li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="card mb-2 py-2 text-center">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item font-bold text-lg"
                                    v-text="user.email"
                                ></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6" v-if="user.phone">
                        <div class="card mb-2 py-2 text-center">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item font-bold text-lg"
                                    v-text="user.phone"
                                ></li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</template>

<script>
    export default {
        props: {
            user: {
                required: true,
                type: Object
            }
        },
        methods: {
            toggleStatusClass() {
                return this.user.status ? 'btn-danger' : 'btn-success'
            },
        }
    }
</script>