<?php
include('../controladores/sesion.php');
if (!isset($_SESSION['usuario'])) {
    header("location: ../../index.php");
}

if ($_SESSION['rol'] !== 'ADMIN') {
    header("location: inicio.php");
    exit;
}
include("cabecera.php");

include('../controladores/mostrar_informacion_empleado.php');

// Procesar búsqueda
$historial = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['busqueda'])) {
    $busqueda = trim($_POST['busqueda']);
    $pdo = new PDO("mysql:host=localhost;dbname=hospitalinfantil", "root", "");

    // Obtener datos del empleado
    $stmtEmpleado = $pdo->prepare("SELECT * FROM empleado WHERE telefono = :telefono");
    $stmtEmpleado->bindValue(':telefono', $busqueda, PDO::PARAM_STR);
    $stmtEmpleado->execute();
    $empleadoData = $stmtEmpleado->fetch(PDO::FETCH_ASSOC);

    if ($empleadoData) {
        // Obtener historial relacionado con el empleado
        $stmtHistorial = $pdo->prepare("SELECT fecha, actividad, usuario FROM historial WHERE usuario = :usuario");
        $stmtHistorial->bindValue(':usuario', $empleadoData['nombres'] . " " . $empleadoData['apellidoPaterno'], PDO::PARAM_STR);
        $stmtHistorial->execute();
        $historial = $stmtHistorial->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
<section class="main-content">
    <div class="content-grid">
        <div class="contentbox patient-info">
            <h1>Consultar empleado</h1>
            <p>Ingrese el número de teléfono del empleado</p>
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
                <!-- Agregamos el formulario para encapsular los campos -->
                <form id="formulario-empleado">
                    <input type="hidden" name="idEmpleado" value="<?php echo $empleadoData['idEmpleado'] ?? ''; ?>">
                    <h2>Datos del Empleado</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre(s):</label>
                            <input type="text" id="nombre" name="nombres" data-nombre-campo="Nombre(s)"
                                value="<?php echo $empleadoData['nombres'] ?? ''; ?>"
                                data-original-value="<?php echo $empleadoData['nombres'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="apellidoPaterno">Apellido paterno:</label>
                            <input type="text" id="apellidoPaterno" name="apellidoPaterno" data-nombre-campo="Apellido paterno"
                                value="<?php echo $empleadoData['apellidoPaterno'] ?? ''; ?>"
                                data-original-value="<?php echo $empleadoData['apellidoPaterno'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="apellidoMaterno">Apellido materno:</label>
                            <input type="text" id="apellidoMaterno" name="apellidoMaterno" data-nombre-campo="Apellido materno"
                                value="<?php echo $empleadoData['apellidoMaterno'] ?? ''; ?>"
                                data-original-value="<?php echo $empleadoData['apellidoMaterno'] ?? ''; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" id="telefono" name="telefono" data-nombre-campo="Teléfono"
                                value="<?php echo $empleadoData['telefono'] ?? ''; ?>"
                                data-original-value="<?php echo $empleadoData['telefono'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" data-nombre-campo="Email"
                                value="<?php echo $empleadoData['email'] ?? ''; ?>"
                                data-original-value="<?php echo $empleadoData['email'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group" id="especialidad-group" style="display: none;">
                            <label for="especialidad">Especialidad:</label>
                            <select id="especialidad" name="especialidad" data-nombre-campo="Especialidad" disabled>
                                <option value="CARDIOLOGIA" <?php echo (isset($empleadoData['especialidad']) && $empleadoData['especialidad'] === 'CARDIOLOGIA') ? 'selected' : ''; ?>>Cardiología</option>
                                <option value="PEDIATRIA" <?php echo (isset($empleadoData['especialidad']) && $empleadoData['especialidad'] === 'PEDIATRIA') ? 'selected' : ''; ?>>Pediatría</option>
                                <option value="NEUROLOGIA" <?php echo (isset($empleadoData['especialidad']) && $empleadoData['especialidad'] === 'NEUROLOGIA') ? 'selected' : ''; ?>>Neurología</option>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <h3>Dirección</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="direccion_calle">Calle:</label>
                            <input type="text" id="direccion_calle" name="calleDireccion" data-nombre-campo="Calle"
                                value="<?php echo $empleadoData['calleDireccion'] ?? ''; ?>"
                                data-original-value="<?php echo $empleadoData['calleDireccion'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="direccion_numero">Número:</label>
                            <input type="text" id="direccion_numero" name="numeroDireccion" data-nombre-campo="Número"
                                value="<?php echo $empleadoData['numeroDireccion'] ?? ''; ?>"
                                data-original-value="<?php echo $empleadoData['numeroDireccion'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="direccion_colonia">Colonia o Fraccionamiento:</label>
                            <input type="text" id="direccion_colonia" name="coloniaDireccion" data-nombre-campo="Colonia o Fraccionamiento"
                                value="<?php echo $empleadoData['coloniaDireccion'] ?? ''; ?>"
                                data-original-value="<?php echo $empleadoData['coloniaDireccion'] ?? ''; ?>" disabled>
                        </div>
                    </div>

                    <hr>
                    <h3>Rol</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="rol">Rol:</label>
                            <select id="rol" name="rol" data-nombre-campo="Rol" onchange="toggleEspecialidad()" disabled>
                                <option value="TRABAJO_SOCIAL" <?php echo (isset($empleadorol['rol']) && $empleadorol['rol'] === 'TRABAJO_SOCIAL') ? 'selected' : ''; ?>>Trabajo social</option>
                                <option value="ADMIN" <?php echo (isset($empleadorol['rol']) && $empleadorol['rol'] === 'ADMIN') ? 'selected' : ''; ?>>Admin</option>
                                <option value="ENFERMERA" <?php echo (isset($empleadorol['rol']) && $empleadorol['rol'] === 'ENFERMERA') ? 'selected' : ''; ?>>Enfermera</option>
                                <option value="DOCTOR" <?php echo (isset($empleadorol['rol']) && $empleadorol['rol'] === 'DOCTOR') ? 'selected' : ''; ?>>Doctor</option>
                            </select>
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="button" id="modificar-btn" onclick="habilitarEdicionEmpleado()"style="background-color: #fea429;"><i class="fa-solid fa-pen"></i>  Modificar</button>
                        <button type="button" id="guardar-btn" class="save-button" style="display: none;" onclick="confirmarCambiosEmpleado(event)"><i class="fa-solid fa-floppy-disk"></i>  Guardar cambios</button>
                        <button type="reset" id="descartar-btn" class="delete-button" style="display: none;" onclick="deshabilitarEdicionEmpleado()"><i class="fa-solid fa-rotate-left"></i>  Descartar cambios</button>
                    </div>
                </form>

                <!-- Formulario para eliminar empleado -->
                <form method="post" action="../controladores/eliminar_empleado.php" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">
                    <input type="hidden" name="idEmpleado" value="<?php echo $empleadoData['idEmpleado'] ?? ''; ?>">
                    <!-- Botón para desactivar empleado -->
                    <button type="button" class="delete-button" onclick="confirmarDesactivacionEmpleado()" style="background-color: #ff4d4d;"><i class="fa-solid fa-trash"></i>  Eliminar empleado</button>
                </form>
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
                                <?php if (!empty($historial)): ?>
                                    <?php foreach ($historial as $registro): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($registro['fecha']); ?></td>
                                            <td><?php echo htmlspecialchars($registro['actividad']); ?></td>
                                            <td><?php echo htmlspecialchars($registro['usuario']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3">No se encontraron registros en el historial.</td>
                                    </tr>
                                <?php endif; ?>
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