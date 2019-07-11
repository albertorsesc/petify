import Swal from 'sweetalert2'

class Toastr {
    static login(message) {
        Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        }).fire({
            type: 'success',
            title: message
        })
    }
}

export default Toastr