<?php
include('cabecera.php'); 
// Inicia la sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<body>
    <section class="main-content">
        <div class="content-grid">
            <div class="contentbox patient-info">
                <h2>Cambiar Contraseña</h2>
                <form id="form-cambiar-contrasena" action="../controladores/modificar_contrasena_empleado.php" method="POST" onsubmit="confirmarCambio(event)">
                    <div class="form-row">
                    <label for="nueva_contrasena">Nueva Contraseña:</label>
                    <input type="password" id="nueva_contrasena" name="nueva_contrasena" required>
                    <br>

                    </div>
                    
                    <div class="form-row">
                    <label for="confirmar_contrasena">Confirmar Contraseña:</label>
                    <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required>
                    <br>
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
</html>
