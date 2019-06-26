import Swal from 'sweetalert2'

class SweetAlert {

    static success(title) {
        Swal.fire({
            position: 'bottom-end',
            type: 'success',
            title: title,
            showConfirmButton: false,
            timer: 3000
        })
    }

    static danger(title, onConfirmedText) {
        Swal.fire({
            title: title,
            text: 'Esta accion no se puede deshacer!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then(result => {
            if (result.value) {
                Event.$emit('SweetAlert:destroy')

                Swal.fire(
                    'Eliminado!',
                    onConfirmedText,
                    'success',
                )
            }
        })
    }

}

export default SweetAlert
