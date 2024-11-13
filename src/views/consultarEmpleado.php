<?php
include("cabecera.php");
if (!isset($_SESSION['usuario'])) {
    header("location: ../../index.php");
}

if ($_SESSION['rol'] !== 'ADMIN') {
    echo ('Acceso denegado, solo personal autorizado');
    exit;
}
?>
<section class="main-content">
    <div class="content-grid">
        <div class="contentbox patient-info">
            <h1>Consultar empleado</h1>
            <p>Ingrese el No. de registro del empleado o su nombre</p>
            <br>
            <form method="post" action="">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar" name="busqueda">
                <button type="submit">Buscar</button>
            </form>
        </div>
    </div>
</section>

<!-- Si no se encurntra la busqueda anadir una tabla con los resultados similares en cuanto si se ingresa algun nombre 
como julian y que salgan todos los julianes y ya si selecciona uno que lo mande a la pantalla que esta aca debajo-->

<!-- Buscar que pedo con esta clase a ver si se esta usando si no para eliminarala a la verga class="contentbox employee-info"-->

<section class="main-content">
    <div class="content-grid">

        <div class="contentbox patienets-info">
            <div class="tabs">
                <button class="tab-btn active" onclick="showTab('informacion')">Informacion</button>
                <button class="tab-btn" onclick="showTab('historial')">Historial</button>
            </div>
            <div id="informacion" class="tab-content active">
                <h2>Datos del Empleado</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre(s):</label>
                        <input type="text" id="nombre" value="Juan" disabled>
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" id="apellidos" value="Gonzalez" disabled>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" value="1234567890" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" value="juan.gonzalez@example.com" disabled>
                    </div>
                    <div class="form-group">
                        <label for="especialidad">Especialidad:</label>
                        <input type="text" id="especialidad" value="Cardiología" disabled>
                    </div>
                </div>

                <hr>
                <h3>Dirección</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="direccion_calle">Calle:</label>
                        <input type="text" id="direccion_calle" value="Calle Principal" disabled>
                    </div>
                    <div class="form-group">
                        <label for="direccion_numero">Número:</label>
                        <input type="text" id="direccion_numero" value="123" disabled>
                    </div>
                    <div class="form-group">
                        <label for="direccion_colonia">Colonia o Fraccionamiento:</label>
                        <input type="text" id="direccion_colonia" value="Colonia Centro" disabled>
                    </div>
                </div>

                <hr>
                <div class="form-row">
                    <h3>Departamento y Rol</h3>
                    <div class="form-group">
                        <label for="departamento">Departamento:</label>
                        <input type="text" id="departamento" value="Doctor" disabled>
                    </div>
                    <div class="form-group">
                        <label for="rol">Rol:</label>
                        <input type="text" id="rol" value="Cardiólogo" disabled>
                    </div>
                </div>

                <div class="button-group">
                    <button type="button" id="edit-button" onclick="enableEditing()">Actualizar Información</button>
                    <button type="button" class="delete-button">Eliminar Información</button>
                    <button type="button" class="save-button" id="save-button" onclick="saveInformation()">Guardar Cambios</button>
                </div>
            </div>




            <div id="historial" class="tab-content">
                <div class="content-grid">
                    <div class="contentbox">
                        <h2>Historial de Actividades</h2>
                        <table class="recent-changes-history-table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Actividad</th>
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>23/10/2024</td>
                                    <td>Modificación de datos de paciente</td>
                                    <td>Ricardo Perez</td>
                                </tr>
                                <tr>
                                    <td>22/10/2024</td>
                                    <td>Registro de nuevo paciente</td>
                                    <td>Ana Lopez</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function enableEditing() {
        // Habilitar todos los campos de entrada
        document.querySelectorAll('input').forEach(function(input) {
            input.disabled = false;
        });

        // Mostrar botón de Guardar y ocultar botón de Actualizar
        document.getElementById('edit-button').style.display = 'none';
        document.getElementById('save-button').style.display = 'inline-block';
    }

    function saveInformation() {
        // Aquí se puede agregar la lógica para guardar los datos (como una solicitud al servidor)

        // Deshabilitar de nuevo los campos de entrada
        document.querySelectorAll('input').forEach(function(input) {
            input.disabled = true;
        });

        // Mostrar botón de Actualizar y ocultar botón de Guardar
        document.getElementById('edit-button').style.display = 'inline-block';
        document.getElementById('save-button').style.display = 'none';
    }
</script>
</body>

</html>