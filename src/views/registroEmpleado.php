<?php
include ('../controladores/sesion.php');
if (!isset($_SESSION['usuario'])) {
    header("location: ../../index.php");
}

if ($_SESSION['rol'] !== 'ADMIN') {
    header("location: inicio.php");
    exit;
}
include("cabecera.php");

require_once '../config.php';
$conn = new conn();
$pdo = $conn->connect();
?>
<section class="main-content">
    <div class="content-grid">

        <div class="contentbox patients-info">
            <div class="tabs">
                <button class="tab-btn active" onclick="showTab('informacion')">Informacion del empleado</button>
            </div>
            <form action="../controladores/registrar_empleado.php" method="POST">

                <div id="informacion" class="tab-content active">
                    <h2>Datos del Empleado</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre(s):</label>
                            <input type="text" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido_paterno">Apellido paterno:</label>
                            <input type="text" id="apellido_paterno" name="apellido_paterno" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido_materno">Apellido materno:</label>
                            <input type="text" id="apellido_materno" name="apellido_materno" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="number" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol:</label>
                            <select id="rol" name="rol" onchange="toggleEspecialidad()" required>
                                <option value="">Seleccione un rol</option>
                                <option value="DOCTOR">Doctor</option>
                                <option value="ENFERMERO">Enfermero</option>
                                <option value="TRABAJO_SOCIAL">Trabajo social</option>
                                <option value="ADMIN">Administrador</option>
                            </select>
                        </div>
                        <div class="form-group" id="especialidad-group" style="display: none;">
                            <label for="especialidad">Area:</label>
                            <select id="especialidad" name="especialidad">
                                <option value="">Seleccione una especialidad</option>
                                <option value="CARDIOLOGIA">Cardiología</option>
                                <option value="PEDIATRIA">Pediatría</option>
                                <option value="NEUROLOGIA">Neurología</option>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <h3>Dirección</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="direccion_calle">Calle:</label>
                            <input type="text" id="direccion_calle" name="direccion_calle" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion_numero">Número:</label>
                            <input type="text" id="direccion_numero" name="direccion_numero" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion_colonia">Colonia o Fraccionamiento:</label>
                            <input type="text" id="direccion_colonia" name="direccion_colonia" required>
                        </div>
                    </div>
                    <hr>
                    <h2>Datos del Usuario</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" id="usuario" name="usuario" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password2">Confirmar contraseña:</label>
                            <input type="password" id="password2" name="password2" required>
                        </div>

                    </div>
                </div>
                <div class="button-group">
                    <button type="submit">Registrar Empleado</button>
                </div>
        </div>
        </form>
    </div>
    </div>
</section>
<section class="full-page-section">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</section>
</body>

</html>