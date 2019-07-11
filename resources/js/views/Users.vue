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
                <table class="table table-striped table-bordered shadow-lg table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Tipo de Usuario</th>
                        <th>Email</th>
                        <th>Tel.</th>
                        <th>Estatus</th>
                        <th>
                            <i class="fa fa-ellipsis-h"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(user, index) in users" :key="user.id">
                        <td v-text="index + 1"></td>
                        <td v-text="user.id"></td>
                        <td v-text="user.fullName"></td>
                        <td v-text="user.userType.displayName"></td>
                        <td v-text="user.email"></td>
                        <td v-text="user.phone"></td>
                        <td>
                            <status-icon :status="user.status"></status-icon>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a :href="`/me/${user.uuid}`" class="btn btn-info btn-xs">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <button type="button"
                                        @click="openModal('put', user)"
                                        class="btn btn-warning btn-xs">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button @click="toggleStatus(user)"
                                        :class="['btn', 'btn-xs', user.status ? 'bg-danger' : 'btn-success', 'text-white']"
                                        :title="user.status ? 'Desactivar' : 'Activar'">
                                    <i class="fas fa-power-off"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <modal :options="modal">
            <template #users>
                <form @submit.prevent>

                    <div class="row">
                        <div class="col-md-6">
                            <div :class="['form-group', errors.first_name ? 'invalid' : '']">
                                <label for="first_name">
                                    <strong class="required">*</strong>
                                    Nombre
                                </label>
                                <input type="text" v-model="user.first_name" id="first_name" class="form-control">
                                <div v-if="errors.first_name"
                                     :class="['alert alert-danger']"
                                     v-text="errors.first_name[0]"
                                ></div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div :class="['form-group', errors.last_name ? 'invalid' : '']">
                                <label for="last_name">
                                    <strong class="required">*</strong>
                                    Apellido
                                </label>
                                <input type="text" v-model="user.last_name" id="last_name" class="form-control">
                                <div v-if="errors.last_name"
                                     :class="['alert alert-danger']"
                                     v-text="errors.last_name[0]"
                                ></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div :class="['form-group', errors.user_type_id ? 'invalid' : '']">
                                <label for="user_type_id">
                                    <strong class="required">*</strong>
                                    Tipo de Usuario
                                </label>
                                <select v-model="user.userType" id="user_type_id" class="form-control">
                                    <option v-for="userType in userTypes"
                                            :value="userType"
                                            v-text="userType.displayName"
                                    ></option>
                                </select>
                                <div v-if="errors.user_type_id"
                                     :class="['alert alert-danger']"
                                     v-text="errors.user_type_id[0]"
                                ></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div :class="['form-group', errors.phone ? 'invalid' : '']">
                                <label for="phone">Telefono</label>
                                <input type="text" v-model="user.phone" id="phone" class="form-control">
                                <div v-if="errors.phone"
                                     :class="['alert alert-danger']"
                                     v-text="errors.phone[0]"
                                ></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div :class="['form-group', errors.email ? 'invalid' : '']">
                                <label for="email">
                                    <strong class="required">*</strong>
                                    Correo Electronico
                                </label>
                                <input type="text" v-model="user.email" id="email" class="form-control">
                                <div v-if="errors.email"
                                     :class="['alert alert-danger']"
                                     v-text="errors.email[0]"
                                ></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div :class="['form-group', errors.password ? 'invalid' : '']">
                                <label for="password">
                                    <strong class="required">*</strong>
                                    Contrasena
                                </label>
                                <input type="password" v-model="user.password" id="password" class="form-control">
                                <div v-if="errors.password"
                                     :class="['alert alert-danger']"
                                     v-text="errors.password[0]"
                                ></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div :class="['form-group', errors.password_confirmation ? 'invalid' : '']">
                                <label for="password_confirmation">
                                    <strong class="required">*</strong>
                                    Confirmar Contrasena
                                </label>
                                <input type="password"
                                       v-model="user.password_confirmation"
                                       id="password_confirmation"
                                       class="form-control">
                                <div v-if="errors.password_confirmation"
                                     :class="['alert alert-danger']"
                                     v-text="errors.password_confirmation[0]"
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
    import StatusIcon from '../components/StatusIcon'

    export default {
        data() {
            return {
                usersUrl: '/api/users',
                userTypesUrl: '/api/user-types',

                users: [],
                userTypes: [],

                userId: 0,

                user: {
                    first_name: '',
                    last_name: '',
                    userType: {
                        id: 0,
                        name: '',
                        displayName: '',
                    },
                    phone: '',
                    email: '',
                    status: false,
                    password: '',
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
                        this.usersUrl,
                        response => { this.users = response.data.data },
                        error => { console.log(error) }
                    )
            },
            store() {
                Requests
                    .store(
                        this.usersUrl,
                        {
                            'first_name': this.user.first_name,
                            'last_name': this.user.last_name,
                            'user_type_id': this.user.userType ? this.user.userType.id : null,
                            'email': this.user.email,
                            'phone': this.user.phone,
                            'password': this.user.password,
                            'password_confirmation': this.user.password_confirmation,
                        },
                        () => {
                            this.closeModal()
                            SweetAlert.success(`El Usuario ha sido creada exitosamente!`)
                            this.index()
                        },
                        error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] }
                    )
            },
            update() {
                Requests
                    .update(
                        this.usersUrl,
                        this.userId,
                        {
                            'first_name': this.user.first_name,
                            'last_name': this.user.last_name,
                            'user_type_id': this.user.userType.id,
                            'email': this.user.email,
                            'phone': this.user.phone,
                            'password': this.user.password,
                            'password_confirmation': this.user.password_confirmation,
                        },
                        () => {
                            this.closeModal()
                            SweetAlert.success(`El Usuario ha sido actualizado exitosamente!`)
                            this.index()
                        },
                        error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] }
                    )
            },
            toggleStatus(user) {
                axios
                    .put(`${this.usersUrl}/${user.uuid}/toggle-status`)
                    .then(
                        () => {
                            this.index()
                            let status = this.user.status ? 'Desactivado' : 'Activado'
                            SweetAlert.success(`El Estatus del Usuario ha sido ${status} exitosamente!`)
                        })
                    .catch(error => { this.errors = error.response.data.errors })
            },
            getUserTypes() {
                Requests
                    .index(
                        this.userTypesUrl,
                        response => { this.userTypes = response.data.data },
                        error => { console.log(error) }
                    )
            },
            openModal(action, user) {
                this.errors = []
                this.user = {}
                this.actionType = ''
                this.modal = {}
                this.modal.body = 'users'

                if (action === 'post') {
                    this.actionType = action
                    this.modal.title = 'Crear nuevo Usuario'
                    this.modal.btnTitle = 'Guardar'
                    this.modal.btnClass = 'btn-success'
                }

                if (action === 'put') {
                    this.userId = user.uuid
                    this.user.first_name = user.firstName
                    this.user.last_name = user.lastName
                    this.user.userType = user.userType
                    this.user.email = user.email
                    this.user.phone = user.phone
                    this.user.password = user.password
                    this.actionType = action
                    this.modal.title = 'Actualizar el Usuario'
                    this.modal.btnTitle = 'Actualizar'
                    this.modal.btnClass = 'btn-success'
                }

                $('#modal').modal('show')
            },
            closeModal() {
                this.user = {}
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
            this.getUserTypes()
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