<?php
include('cabecera.php');
if (!isset($_SESSION['usuario'])) {
	header("location: ../../index.php");
}

if ($_SESSION['rol'] !== 'ADMIN') {
	echo('Acceso denegado, solo personal autorizado');
    exit;
}

require_once '../config.php';
$conn = new conn();
$pdo = $conn->connect();
?>
    <section class="main-content">
        <div class="content-grid">
            <div class="contentbox employee-info">
                <form action="">
                    <h2>Datos del Empleado</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre(s):</label>
                            <input type="text" id="nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" id="apellidos">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" id="telefono">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="especialidad">Especialidad:</label>
                            <input type="text" id="especialidad">
                        </div>
                    </div>

                    <hr>
                    <h3>Dirección</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="direccion_calle">Calle:</label>
                            <input type="text" id="direccion_calle">
                        </div>
                        <div class="form-group">
                            <label for="direccion_numero">Número:</label>
                            <input type="text" id="direccion_numero">
                        </div>
                        <div class="form-group">
                            <label for="direccion_colonia">Colonia o Fraccionamiento:</label>
                            <input type="text" id="direccion_colonia">
                        </div>
                    </div>

                    <hr>
                    <h3>Seleccionar Departamento y Rol</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="departamento">Departamento:</label>
                            <select id="departamento">
                                <option value="doctor">Doctor</option>
                                <option value="enfermero">Enfermero</option>
                                <option value="administrador">Administrador</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol:</label>
                            <select id="rol">
                                <option value="DOCTOR">Doctor</option>
                                <option value="ENFERMERO">Enfermero</option>
                                <option value="TRABAJO_SOCIAL">Trabajo social</option>
                                <option value="ADMIN">Administrador</option>
                            </select>
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="submit">Registrar Empleado</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function toggleMenu() {
            document.body.classList.toggle('menu-closed');
        }

        // Asegúrate de que el menú esté abierto por defecto
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.remove('menu-closed');
        });
    </script>
</body>
</html>
