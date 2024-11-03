
function acceso() {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: '¡ B I E N V E N I D O !',
        text: ' al Sistema Web de Agenda ',
        showConfirmButton: false,
        timer: 2000
    }).then(function () {
        location.href = 'menu.php';
    });
}

function noacceso() {
    Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Alerta: Usuario y/o Contraseña incorrectas, por favor verifique',
        text: 'vuelva a intertarlo de nuevo ...',
        showConfirmButton: false,
        timer: 2000
    }).then(function () {
        location.href = 'login.php';
    });
}


function insertar() {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Registro Agregado con Exito',
        showConfirmButton: false,
        timer: 2000
    }).then(function () {
        location.href = 'administrar.php';
    });
}

function noinsertar() {
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'No fue posible agregar el registro, ',
        text: 'vuelva a intertarlo de nuevo ...',
        showConfirmButton: false,
        timer: 2000
    }).then(function () {
        location.href = 'insertar.php';
    });
}

function eliminar() {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Registro eliminado con Exito',
        showConfirmButton: false,
        timer: 2000
    }).then(function () {
        location.href = 'administrar.php';
    });
}

function noeliminar() {
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'No fue posible eliminar el registro, ',
        text: 'vuelva a intertarlo de nuevo ...',
        showConfirmButton: false,
        timer: 2000
    }).then(function () {
        location.href = 'administrar.php';
    });
}

function actualizar() {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Registro actualizado con Exito',
        showConfirmButton: false,
        timer: 2000
    }).then(function () {
        location.href = 'administrar.php';
    });
}

function noactualizar() {
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'No fue posible actualizar el registro, ',
        text: 'vuelva a intertarlo de nuevo ...',
        showConfirmButton: false,
        timer: 2000
    }).then(function () {
        //location.href= 'administrar.php';
    });
}

