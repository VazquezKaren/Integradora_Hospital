<?php
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES, MODIFICAR EN CASO DE CAMBIAR RUTAS DE LOCALIZACION DE LOS ARCHIVOS DEL PROYECTO
include('cabecera.php');
require_once('../controladores/historial_modificaciones.php');
?>

<section>
    <div class="content-grid">
        <!-- Tabla de actividades del historial -->
        <div class="contentbox">
            <h2>Historial de Actividades</h2>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Actividad</th>
                        <th>Usuario</th>
                        <th>Nombre Empleado</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($actividades as $actividad): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($actividad['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($actividad['actividad']); ?></td>
                            <td><?php echo htmlspecialchars($actividad['usuario']); ?></td>
                            <td><?php echo htmlspecialchars($actividad['nombreEmpleado']); ?></td>
                            <td><?php echo htmlspecialchars($actividad['telefono']); ?></td>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</section>
</body>

</html>