<?php
include("cabecera.php");
if (!isset($_SESSION['usuario'])) {
    header("location: ../../index.php");
}

if ($_SESSION['rol'] !== 'ADMIN') {
    echo ('Acceso denegado, solo personal autorizado');
    exit;
}

include('../controladores/mostrar_informacion_empleado.php')
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
                        <input type="text" id="nombre" value="<?php echo $empleadoData['nombres'] ?? ''; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellido paterno:</label>
                        <input type="text" id="apellidos" value="<?php echo $empleadoData['apellidoPaterno'] ?? ''; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellido materno:</label>
                        <input type="text" id="apellidos" value="<?php echo $empleadoData['apellidoPaterno'] ?? ''; ?>" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" value="<?php echo $empleadoData['telefono'] ?? ''; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" value="<?php echo $empleadoData['email'] ?? ''; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="especialidad">Especialidad:</label>
                        <select id="rol" disabled>
                            <option value="CARDIOLOGIA" <?php echo (isset($empleadoData['especialidad']) && $empleadoData['especialidad'] === 'CARDIOLOGIA') ? 'selected' : ''; ?>>Cardiologia</option>
                            <option value="PEDIATRIA" <?php echo (isset($empleadoData['especialidad']) && $empleadoData['especialidad'] === 'PEDIATRIA') ? 'selected' : ''; ?>>Pediatria</option>
                            <option value="NEUROLOGIA" <?php echo (isset($empleadoData['especialidad']) && $empleadoData['especialidad'] === 'NEUROLOGIA') ? 'selected' : ''; ?>>Neurologia</option>
                        </select>
                    </div>
                </div>

                <hr>
                <h3>Dirección</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="direccion_calle">Calle:</label>
                        <input type="text" id="direccion_calle" value="<?php echo $empleadoData['calleDireccion'] ?? ''; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="direccion_numero">Número:</label>
                        <input type="text" id="direccion_numero" value="<?php echo $empleadoData['numeroDireccion'] ?? ''; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="direccion_colonia">Colonia o Fraccionamiento:</label>
                        <input type="text" id="direccion_colonia" value="<?php echo $empleadoData['coloniaDireccion'] ?? ''; ?>" disabled>
                    </div>
                </div>

                <hr>
                <h3>Rol</h3>


                <div class="form-row">
                    <div class="form-group">
                        <label for="rol">Rol:</label>
                        <select id="rol" disabled>
                            <option value="TRABAJO_SOCIAL" <?php echo (isset($empleadorol['rol']) && $empleadorol['rol'] === 'TRABAJO_SOCIAL') ? 'selected' : ''; ?>>Trabajo social</option>
                            <option value="ADMIN" <?php echo (isset($empleadorol['rol']) && $empleadorol['rol'] === 'ADMIN') ? 'selected' : ''; ?>>Admin</option>
                            <option value="ENFERMERA" <?php echo (isset($empleadorol['rol']) && $empleadorol['rol'] === 'ENFERMERA') ? 'selected' : ''; ?>>Enfermera</option>
                            <option value="DOCTOR" <?php echo (isset($empleadorol['rol']) && $empleadorol['rol'] === 'DOCTOR') ? 'selected' : ''; ?>>Doctor</option>
                        </select>
                    </div>

                </div>

                <div class="button-group">
                    <button type="button" id="modificar-btn" onclick="habilitarEdicion()">Modificar</button>
                    <button type="submit" id="guardar-btn" class="save-button" style="display: none;" onclick="deshabilitarEdicion()">Guardar cambios</button>
                    <button type="reset" id="descartar-btn" class="delete-button" style="display: none;" onclick="deshabilitarEdicion()">Descartar cambios</button>

                    <form method="post" action="../controladores/eliminar_empleado.php" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">
                        <input type="hidden" name="idEmpleado" value="<?php echo $empleadoData['idEmpleado'] ?? ''; ?>">
                        <button type="submit" class="delete-button" >Eliminar empleado</button>
                    </form>
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


</body>

</html>






<!-- Cuando queramos realizar los cambios se debe mostrar una notificacion con los cambios que se desean realizar para confirmar si son correctos -->