<?php
include('cabecera.php'); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<body>
    <section class="main-content">
        <div class="content-grid">
            <div class="contentbox patient-info">
                <h2>Datos del Empleado</h2>
                <form id="form-cambiar-contrasena" action="../controladores/modificar_contrasena_empleado.php" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nueva_contrasena">Nueva Contraseña:</label>
                            <input type="password" id="nueva_contrasena" name="nueva_contrasena" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="confirmar_contrasena">Confirmar Contraseña:</label>
                            <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required oninput="validarContrasenas()">
                            <br>
                            <span id="error-contrasena" style="color: red; display: none;">Las contraseñas no coinciden</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button id="btn-cambiar-contrasena" type="button">Actualizar Contraseña</button>
                            <button type="button" onclick="cancelarCambio()">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

<script>
    window.onload = function() {
        document.getElementById('nueva_contrasena').oninput = validarContrasenas;
        document.getElementById('confirmar_contrasena').oninput = validarContrasenas;
    };

    function validarContrasenas() {
        const nuevaContrasena = document.getElementById('nueva_contrasena').value;
        const confirmarContrasena = document.getElementById('confirmar_contrasena').value;
        const errorContrasena = document.getElementById('error-contrasena');

        if (!nuevaContrasena || !confirmarContrasena) {
            return false; // Campos vacíos
        }

        if (nuevaContrasena !== confirmarContrasena) {
            errorContrasena.style.display = 'block';
            return false;
        } else {
            errorContrasena.style.display = 'none';
            return true;
        }
    }

    $('#btn-cambiar-contrasena').click(function () {
        const nuevaContrasena = document.getElementById('nueva_contrasena').value;
        const confirmarContrasena = document.getElementById('confirmar_contrasena').value;

        if (!nuevaContrasena || !confirmarContrasena) {
            Swal.fire({
                title: "Error",
                text: "Por favor, completa todos los campos antes de continuar.",
                icon: "error",
                confirmButtonText: "Aceptar"
            });
            return;
        }

        if (validarContrasenas()) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¿Estás seguro de cambiar la contraseña?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirmar",
                didOpen: () => {
                    const icon = document.querySelector('.swal2-icon.swal2-warning');
                    if (icon) {
                        icon.style.fontSize = '40px';
                        icon.style.width = '60px';
                        icon.style.height = '60px';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Sesión cerrada",
                        text: "Vuelve a iniciar sesión con tu nueva contraseña.",
                        icon: "success",
                        confirmButtonText: "Aceptar"
                    }).then(() => {
                        document.getElementById('form-cambiar-contrasena').submit();
                        window.location.href = '../../src/controladores/CerrarSesion.php';
                    });
                }
            });
        } else {
            Swal.fire({
                title: "Error",
                text: "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.",
                icon: "error",
                confirmButtonText: "Aceptar"
            });
        }
    });

    function cancelarCambio() {
        Swal.fire({
            title: "Cancelado",
            text: "El cambio de contraseña fue cancelado.",
            icon: "info",
            confirmButtonText: "Aceptar"
        });
    }
</script>