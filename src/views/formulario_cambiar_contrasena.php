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
                <form id="form-cambiar-contrasena" action="../controladores/modificar_contrasena_empleado.php" method="POST" onsubmit="confirmarCambio(event)">
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
                            <button type="submit">Actualizar Contraseña</button>
                            <button type="button" onclick="cancelarCambio()">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

    