
var popup = document.getElementById('popup_message');
if (popup) {
    // show a message in a toast
    Swal.fire({
        toast: true,
        animation: false,
        icon: popup.dataset.type,
        title: popup.dataset.message,
        type: popup.dataset.type,
        position: 'top-right',
        timer: 3000,
        showConfirmButton: false,
    });
}

const deleteBtns = document.querySelectorAll('form.delete');

deleteBtns.forEach((formDelete) => {
    formDelete.addEventListener('submit', function (event) {
        event.preventDefault();
        var doubleconfirm = event.target.classList.contains('double-confirm');
        Swal.fire({
            title: 'Sei sicuro?',
            text: "Per favore conferma la tua richiesta!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#20c997',
            cancelButtonText: 'Cancella',
            confirmButtonText: 'Si, conferma!'
        }).then((result) => {
            if (result.value) {

                // if double confirm
                if (doubleconfirm) {

                    Swal.fire({
                        title: 'Conferma richiesta',
                        html: "Per favore digita <b>CONFERMA</b>",
                        input: 'text',
                        type: 'warning',
                        inputPlaceholder: 'CONFERMA',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'Conferma',
                        cancelButtonColor: '#20c997',
                        cancelButtonText: 'Annulla',
                        showLoaderOnConfirm: true,
                        allowOutsideClick: () => !Swal.isLoading(),
                        preConfirm: (txt) => {
                            return (txt.toUpperCase() == "CONFERMA");
                        },

                    }).then((result) => {
                        if (result.value) this.submit();
                    })
                } else {
                    this.submit();
                }


            }
        });


    });

});