<template>
    <div>

        <div class="row-fluid">
            <button @click="openModal('post')"
                    class="btn btn-primary btn-md shadow-lg float-left">
                <i class="fa fa-plus"></i>
            </button>
            <div class="text-center">
                <h3>Razas</h3>
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
                        <th>Especie</th>
                        <th>Estatus</th>
                        <th>
                            <i class="fa fa-ellipsis-h"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(breed, index) in breeds" :key="breed.id">
                        <td v-text="index + 1"></td>
                        <td v-text="breed.id"></td>
                        <td v-text="breed.name"></td>
                        <td v-text="breed.specie.name"></td>
                        <td>
                            <status-icon :status="breed.status"></status-icon>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button"
                                        @click="openModal('put', breed)"
                                        class="btn btn-warning btn-xs">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button @click="toggleStatus(breed)"
                                        :class="['btn', 'btn-xs', breed.status ? 'bg-grey' : 'btn-success']"
                                        :title="breed.status ? 'Desactivar' : 'Activar'">
                                    <i class="fas fa-power-off"></i>
                                </button>
                                <button type="button"
                                        @click="onDelete(breed)"
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
            <template #breeds>
                <form @submit.prevent>

                    <div class="row">
                        <div class="col-md-6">
                            <div :class="['form-group', errors.name ? 'invalid' : '']">
                                <label for="name">
                                    <strong class="required">*</strong>
                                    Nombre (name)
                                </label>
                                <input type="text" v-model="breed.name" id="name" class="form-control">
                                <div v-if="errors.name"
                                     :class="['alert alert-danger']"
                                     v-text="errors.name[0]"
                                ></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div :class="['form-group', errors.specie_id ? 'invalid' : '']">
                                <label for="specie_id">
                                    <strong class="required">*</strong>
                                    Especie
                                </label>
                                <select v-model="breed.specie" id="specie_id" class="form-control">
                                    <option v-for="specie in species"
                                            :value="specie"
                                            v-text="specie.name"
                                    ></option>
                                </select>
                                <div v-if="errors.specie_id"
                                     :class="['alert alert-danger']"
                                     v-text="errors.specie_id[0]"
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

    import Modal from '../components/Modal'
    import Requests from '../models/Requests'
    import SweetAlert from '../models/SweetAlert'
    import StatusIcon from '../components/StatusIcon'

    export default {
        data() {
            return {
                breedsUrl: '/api/breeds',
                speciesUrl: '/api/species',

                breeds: [],
                species: [],

                breedId: 0,

                breed: {
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
                        this.breedsUrl,
                        response => { this.breeds = response.data.data },
                        error => { console.log(error) }
                    )
            },
            store() {
                Requests
                    .store(
                        this.breedsUrl,
                        {
                            'specie_id': this.breed.specie ? this.breed.specie.id : null,
                            'name': this.breed.name
                        },
                        () => {
                            this.closeModal()
                            SweetAlert.success(`La Raza ha sido registrada exitosamente!`)
                            this.index()
                        },
                        error => { this.errors = error.response.status === 422 ? error.response.data.errors :[] }
                    )
            },
            update() {
                Requests
                    .update(
                        this.breedsUrl,
                        this.breedId,
                        {
                            'specie_id': this.breed.specie.id,
                            'name': this.breed.name
                        },
                        () => {
                            this.closeModal()
                            SweetAlert.success(`La Raza ha sido actualizada exitosamente!`)
                            this.index()
                        },
                        error => { this.errors = error.response.status === 422 ? error.response.data.errors :[] }
                    )
            },
            destroy() {
                Requests
                    .destroy(
                        this.breedsUrl,
                        this.breedId,
                        () => {
                            this.index()
                            SweetAlert.success(`La Raza ha sido eliminada exitosamente!`)
                        },
                        error => { console.log(error) }
                    )
            },
            getSpecies() {
                Requests
                    .index(
                        this.speciesUrl,
                        response => { this.species = response.data.data },
                        error => { console.log(error) }
                    )
            },
            toggleStatus(breed) {
                Requests
                    .update(
                        this.breedsUrl,
                        breed.id,
                        { 'status': ! breed.status },
                        response => {
                            this.index()

                            let status = this.breed.status = response.data.data.status
                            SweetAlert.success(
                                `El Estatus de la Raza ha sido ${status ? 'Activado' : 'Desactivado' } exitosamente!`)
                        },
                        error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] }
                    )
            },
            openModal(action, breed) {
                this.errors = []
                this.breed = {}
                this.actionType = ''
                this.modal = {}
                this.modal.body = 'breeds'

                if (action === 'post') {
                    this.actionType = action
                    this.modal.title = 'Registrar nueva Raza'
                    this.modal.btnTitle = 'Guardar'
                    this.modal.btnClass = 'btn-success'
                }

                if (action === 'put') {
                    this.breedId = breed.id
                    this.breed.name = breed.name
                    this.breed.specie = breed.specie
                    this.actionType = action
                    this.modal.title = 'Actualizar la Raza'
                    this.modal.btnTitle = 'Actualizar'
                    this.modal.btnClass = 'btn-success'
                }

                $('#modal').modal('show')
            },
            closeModal() {
                this.breed = {}
                this.errors = []
                this.actionType = ''
                this.modal = {}
                $('#modal').modal('hide')
            },
            onDelete(breed) {
                this.breedId = breed.id
                SweetAlert.danger(
                    'Eliminar la Raza: ' + breed.name,
                    'La Raza ha sido eliminada exitosamente!',
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
            this.getSpecies()
        },
        components: {
            Modal,
            StatusIcon,
        },
    }
</script>

<style scoped>
    .table {
        vertical-align: middle;
        text-align: center;
    }
</style>