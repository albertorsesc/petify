<template>
    <div>

        <div class="row-fluid">
            <button type="button"
                    @click="openModal('post')"
                    class="btn btn-primary text-white shadow-lg">
                <i class="fa fa-plus"></i>
            </button>
        </div>

        <hr>

        <div class="row">

            <div class="col-md-12">
                <table class="table table-striped table-bordered shadow-lg table-hover card">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>DisplayName</th>
                        <th>
                            <i class="fa fa-ellipsis-h"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(specie, index) in species" :key="specie.id">
                        <td v-text="index + 1"></td>
                        <td v-text="specie.id"></td>
                        <td v-text="specie.name"></td>
                        <td v-text="specie.displayName"></td>
                        <td>
                            <div class="btn-group">
                                <button type="button"
                                        @click="openModal('put', specie)"
                                        class="btn btn-warning btn-xs">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <!--<button @click="toggleStatus(specie)"
                                        :class="['btn', 'btn-xs', toggleStatusClass(specie)]">
                                    <i class="fas fa-power-off"></i>
                                </button>-->
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <modal :options="modal">
            <template #species>
                <form @submit.prevent>

                    <div class="row">
                        <div class="col-md-6">
                            <div :class="['form-group', errors.name ? 'invalid' : '']">
                                <label for="name">
                                    <strong class="required">*</strong>
                                    Nombre (name)
                                </label>
                                <input type="text" v-model="specie.name" id="name" class="form-control">
                                <div v-if="errors.name"
                                     :class="['alert alert-danger']"
                                     v-text="errors.name[0]"
                                ></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div :class="['form-group', errors.display_name ? 'invalid' : '']">
                                <label for="display_name">
                                    <strong class="required">*</strong>
                                    Nombre a mostrar (display_name)
                                </label>
                                <input type="text" v-model="specie.displayName" id="display_name" class="form-control">
                                <div v-if="errors.display_name"
                                     :class="['alert alert-danger']"
                                     v-text="errors.display_name[0]"
                                ></div>
                            </div>
                        </div>
                    </div>

                </form>
            </template>
        </modal>

    </div>
</template>

<script>

    import Requests from '../models/Requests'
    import SweetAlert from '../models/SweetAlert'
    import Modal from '../components/Modal'

    export default {
        data() {
            return {
                speciesUrl: '/api/species',

                species: [],

                specieId: 0,

                specie: {
                    name: '',
                    displayName: '',
                    status: true,
                },

                errors: [],
                actionType: '',
                modal: {
                    title: '',
                    body: '',
                    btnTitle: '',
                    btnClass: '',
                }
            }
        },
        methods: {
            index() {
                Requests
                    .index(
                        this.speciesUrl,
                        response => { this.species = response.data.data },
                        error => { console.log(error) }
                    )
            },
            store() {
                Requests
                    .store(
                        this.speciesUrl,
                        {
                            'name': this.specie.name,
                            'display_name': this.specie.displayName,
                        },
                        () => {
                            this.closeModal()
                            SweetAlert.success(`La Especie ha sido registrada exitosamente!`)
                            this.index()
                        },
                        error => {
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors
                            }
                        }
                    )
            },
            update() {
                Requests
                    .update(
                        this.speciesUrl,
                        this.specieId,
                        {
                            'name': this.specie.name,
                            'display_name': this.specie.displayName,
                        },
                        () => {
                            this.closeModal()
                            SweetAlert.success(`La Especie ha sido actualizada exitosamente!`)
                            this.index()
                        },
                        error => {
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors
                            }
                        }
                    )
            },
            openModal(action, specie) {
                this.errors = []
                this.specie = {}
                this.actionType = ''
                this.modal = {}
                this.modal.body = 'species'

                if (action === 'post') {
                    this.actionType = action
                    this.modal.title = 'Registrar nueva Especie'
                    this.modal.btnTitle = 'Guardar'
                    this.modal.btnClass = 'btn-success'
                }

                if (action === 'put') {
                    this.specieId = specie.id
                    this.specie.name = specie.name
                    this.specie.displayName = specie.displayName
                    this.actionType = action
                    this.modal.title = 'Actualizar la Especie'
                    this.modal.btnTitle = 'Actualizar'
                    this.modal.btnClass = 'btn-success'
                }

                $('#modal').modal('show')
            },
            closeModal() {
                this.specie = {}
                this.errors = []
                this.actionType = ''
                this.modal = {}
                $('#modal').modal('hide')
            },
            formAction() {
                if (this.actionType === 'post') {
                    this.store()
                }

                if (this.actionType === 'put') {
                    this.update()
                }
            },
            eventRegistration() {
                Event.$on('modal:submit', () => { this.formAction() })
                Event.$on('modal:open', () => { this.openModal() })
                Event.$on('modal:close', () => { this.closeModal() })
            }
        },
        mounted() {
            this.eventRegistration()
            this.index()
        },
        components: {
            Modal,
        },
    }
</script>

<style scoped>
    .table {
        vertical-align: middle;
        text-align: center;
    }
</style>