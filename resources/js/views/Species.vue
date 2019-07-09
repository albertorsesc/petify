<template>
    <div>

        <div class="row-fluid">
            <button @click="openModal('post')"
                    class="btn btn-primary btn-md shadow-lg float-left">
                <i class="fa fa-plus"></i>
            </button>
            <div class="text-center">
                <h3>Especies</h3>
            </div>
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
                        <td>
                            <div class="btn-group">
                                <button type="button"
                                        @click="openModal('put', specie)"
                                        class="btn btn-warning btn-xs">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button @click="toggleStatus(specie)"
                                        :class="['btn', 'btn-xs', specie.status ? 'bg-grey' : 'btn-success']"
                                        :title="specie.status ? 'Desactivar' : 'Activar'">
                                    <i class="fas fa-power-off"></i>
                                </button>
                                <button type="button"
                                        @click="onDelete(specie)"
                                        class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i>
                                </button>
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
                        <div class="col-md-12">
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
                    status: false,
                    btnClass: '',
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
                        { 'name': this.specie.name },
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
                        { 'name': this.specie.name },
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
            destroy() {
                Requests
                    .destroy(
                        this.speciesUrl,
                        this.specieId,
                        () => {
                            this.index()
                            SweetAlert.success(`La Especie ha sido eliminada exitosamente!`)
                        },
                        error => { console.log(error) }
                    )
            },
            toggleStatus(specie) {
                Requests
                    .update(
                        this.speciesUrl,
                        specie.id,
                        { 'status': ! specie.status },
                        response => {
                            this.index()

                            let status = this.specie.status = response.data.data.status
                            SweetAlert.success(
                                `El Estatus de la Especie ha sido ${status ? 'Activado' : 'Desactivado' } exitosamente!`)
                        },
                        error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] }
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
                    this.specie.status = specie.status
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
            onDelete(specie) {
                this.specieId = specie.id
                SweetAlert.danger(
                    'Eliminar la Especie: ' + specie.name,
                    'La Especie ha sido eliminada exitosamente!',
                )
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
                Event.$on('SweetAlert:destroy', () => { this.destroy() })
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