const boton = document.querySelector('#boton_prueba');
boton.addEventListener('click', aplicar);

function aplicar(e){
    e.preventDefault();

    Swal.fire({
        title: 'Error',
        text: 'Campo es obligatorio',
        icon: 'error',
        confirmButtonText: 'Confirmar',
        })
}