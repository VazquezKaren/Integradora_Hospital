<?php 
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES, MODIFICAR EN CASO DE CAMBIAR RUTAS DE LOCALIZACION DE LOS ARCHIVOS DEL PROYECTO
include('cabecera.php'); 
?>



    <section>
        <div class="content-grid">
            <div class="contentbox">
                <h2>Historial de Actividad</h2>
            </div>
        </div>
    </section>

    <section>
        <div class="content-grid">
            <!-- Tabla de actividades del historial -->
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

            <!-- Tabla de cambios recientes -->
            <div class="contentbox">
                <h2>Cambios Recientes</h2>
                <table class="recent-changes-history-table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Campo Modificado</th>
                            <th>Anterior</th>
                            <th>Nuevo</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>23/10/2024</td>
                            <td>Dirección</td>
                            <td>Calle Falsa 123</td>
                            <td>Calle Verdadera 456</td>
                            <td>Ricardo Perez</td>
                        </tr>
                        <tr>
                            <td>22/10/2024</td>
                            <td>Teléfono</td>
                            <td>123-456-7890</td>
                            <td>098-765-4321</td>
                            <td>Ana Lopez</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>