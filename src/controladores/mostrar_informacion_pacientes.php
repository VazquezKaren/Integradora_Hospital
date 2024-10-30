<?php
// Incluir la configuración de la base de datos
include '../../config.php';

// Inicializar la variable para almacenar los detalles del paciente
$paciente = null;

// Verificar si se envió el formulario de búsqueda
if (isset($_POST['busqueda'])) {
    // Sanitizar el ID de búsqueda
    $idPaciente = filter_var($_POST['busqueda'], FILTER_SANITIZE_NUMBER_INT);

    try {
        // Preparar la consulta para buscar el paciente
        // SQL query to fetch patient details along with tutor and social work information
        $sql = "
            SELECT p.*, t.*, ts.*
            FROM paciente p
            JOIN tutor t ON p.id = t.idPaciente
            JOIN trabajo_social ts ON p.id = ts.idPaciente
            WHERE p.id = :idPaciente
        ";
                
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idPaciente' => $idPaciente]);

        // Verificar si se encontró el paciente
        if ($stmt->rowCount() > 0) {
            $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
        } catch (PDOException $e) {
        }
        } catch (Exception $e) {
        error_log("Error al buscar el paciente: " . $e->getMessage());
        echo "Ocurrió un error al buscar el paciente. Por favor, inténtelo de nuevo más tarde.";
        }
    }

    // Incluir la plantilla de la página
    ?>
    <section class="main-content">
        <div class="content-grid">
        <div class="contentbox patient-info">
            <h1>Informacion del paciente</h1>
            <p>Ingrese el No. de registro del paciente</p>
            <br>
            <form method="POST">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Buscar" name="busqueda" required>
            <button type="submit">Buscar</button>
            </form>

            <?php if ($paciente): ?>
            <h2>Detalles del Paciente</h2>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($paciente['nombre'] . ' ' . $paciente['apellido_paterno'] . ' ' . $paciente['apellido_materno']); ?></p>
            <p><strong>Fecha de Nacimiento:</strong> <?php echo htmlspecialchars($paciente['fecha_nacimiento']); ?></p>
            <p><strong>Edad:</strong> <?php echo htmlspecialchars($paciente['edad']); ?></p>
            <p><strong>Lugar de Nacimiento:</strong> <?php echo htmlspecialchars($paciente['lugar_nacimiento']); ?></p>
            <p><strong>Sexo:</strong> <?php echo htmlspecialchars($paciente['sexo']); ?></p>
            <p><strong>Servicio Solicitado:</strong> <?php echo htmlspecialchars($paciente['servicio_solicitado']); ?></p>
            <p><strong>Diagnóstico Inicial:</strong> <?php echo htmlspecialchars($paciente['dx_registro']); ?></p>
            <h3>Información del Tutor</h3>
            <p><strong>Nombre del Tutor:</strong> <?php echo htmlspecialchars($paciente['tutor_nombre'] . ' ' . $paciente['tutor_apellido_paterno'] . ' ' . $paciente['tutor_apellido_materno']); ?></p>
            <p><strong>Parentesco:</strong> <?php echo htmlspecialchars($paciente['parentesco']); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($paciente['telefono']); ?></p>
            <p><strong>Ocupación:</strong> <?php echo htmlspecialchars($paciente['ocupacion']); ?></p>
            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($paciente['tutor_direccion_calle'] . ' ' . $paciente['tutor_direccion_numero'] . ', ' . $paciente['tutor_direccion_colonia']); ?></p>
            <h3>Trabajo Social</h3>
            <p><strong>Número de Personas en el Hogar:</strong> <?php echo htmlspecialchars($paciente['personas_hogar']); ?></p>
            <p><strong>Clasificación de Trabajo Social:</strong> <?php echo htmlspecialchars($paciente['clasificacion_trabajo_social']); ?></p>
            <p><strong>Índice Económico:</strong> <?php echo htmlspecialchars($paciente['indice_economico']); ?></p>
            <!-- Agregar más campos según sea necesario -->
            <?php else: ?>
            <?php if (isset($_POST['busqueda'])): ?>
                <p>No se encontró ningún paciente con el ID proporcionado.</p>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        </div>
    </section>

    <!-- Agregar más campos según sea necesario -->
            <?php else: ?>
                <?php if (isset($_POST['busqueda'])): ?>
                    <p>No se encontró ningún paciente con el ID proporcionado.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
function showTab(tabName) {
    var tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(function(tab) {
        tab.style.display = 'none';
    });
    document.getElementById(tabName).style.display = 'block';
}
</script>
