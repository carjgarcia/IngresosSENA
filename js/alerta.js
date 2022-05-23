//Creando eventos para los botones.
//Botón Prueba
const prueba = document.querySelector('#btnPrueba');
prueba.addEventListener('click', alertaPrueba);

//Botón Ingresar
const ingresar = document.querySelector('#btnIngresar');
ingresar.addEventListener('click', alertaIniciar);

//Botón Registrar
const registrar = document.querySelector('#btnRegistrar');
registrar.addEventListener('click', alertaRegistrar);

//Función de prueba
function alertaPrueba(e){
    e.preventDefault();

    Swal.fire({
        title: 'Prueba exitosa',
        icon: 'success',
        confirmButtonText: 'Perfecto!',
        })
}

//Inicio de sesión
function alertaIniciar(e){
    e.preventDefault();

    Swal.fire({
        text: 'Ha iniciado sesión correctamente',
        icon: 'success',
        confirmButtonText: 'Continuar',
        })
}

//Registro de nuevo usuario
function alertaRegistrar(e){
    e.preventDefault();

    Swal.fire({
        title: 'Registro exitoso',
        text: '¡Bienvenido al sistema!',
        icon: 'success',
        confirmButtonText: 'Continuar',
        })
}