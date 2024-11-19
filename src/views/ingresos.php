<?php
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES, MODIFICAR EN CASO DE CAMBIAR RUTAS DE LOCALIZACION DE LOS ARCHIVOS DEL PROYECTO
include('cabecera.php');
include('../controladores/tabla_ingresos.php')
?>

<!--  BOOTSTRAP  -->

<section class="main-content">
    <div class="content-grid">
        <div class="contentbox patient-info">
            <h1>Buscar ingresos</h1>
            <p>Ingrese el No. del empleado para observar los registros realizados</p>
            <br>
            <form method="post" action="">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar" name="busqueda">
                <button type="submit">Buscar</button>
            </form>
        </div>
    </div>
</section>

<section class="main-content">
    <div class="content-grid">
        <div class="contentbox patient-info">
            <h2>Ingresos Recientes</h2>

            <table class="recent-changes-history-table" id="tabla_ingresos">
                <thead>
                    <tr>

                        <th>Fecha Ingreso</th>
                        <th>Hora Ingreso</th>
                        <th>Paciente</th>
                        <th>Fecha Egreso</th>
                        <th>Hora Egreso</th>
                        <th>Egreso</th>
                        <th>Motivo</th>
                        <th>Servicio Solicitado</th>
                        <th>No.Empleado</th>
                        <th>Empleado Responsable</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($ingresos as $ingresos) {
                    ?>
                        <tr>
                            <td><?php echo $ingresos['fechaIngreso'] ?></td>
                            <td><?php echo $ingresos['horaIngreso'] ?></td>
                            <td><?php echo $ingresos['nombrePaciente'] . " " . $ingresos['apellidoPaternoPaciente'] . " " . $ingresos['apellidoMaternoPaciente'] ?></td>
                            <td><?php echo $ingresos['fechaEgreso'] ?></td>
                            <td><?php echo $ingresos['horaEgreso'] ?></td>
                            <td><?php
                                if ($ingresos['egreso'] == 1) {
                                ?> <i class="fa-solid fa-check"></i>
                                <?php
                                } else {
                                ?> <i class="fa-solid fa-xmark"></i>
                                <?php
                                }
                                ?></td>
                            <td><?php echo $ingresos['motivo'] ?></td>
                            <td><?php echo $ingresos['servicioSolicita'] ?></td>
                            <td><?php echo $ingresos['idEmpleado'] ?></td>
                            <td><?php echo $ingresos['nombreEmpleado'] . " " . $ingresos['apellidoPaternoEmpleado'] ?></td>
                            <td>
                                <!-- Metodo de mandar una accion a un formulario -->
                                <!-- <form action="../controladores/mostrar_informacion_pacientes.php" method="POST">
                                    <input type="text" class="forma-control" name="idPaciente" value="<?php echo $ingresos['fkIdPaciente']; ?>">
                                </form> -->

                                <?php if (isset($ingresos['fkIdPaciente'])): ?>
                                    <!-- Botón para abrir el modal -->
                                    <input type="text" class="forma-control" name="idPaciente" value="<?php echo $ingresos['fkIdPaciente']; ?>">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" data-fk-id-paciente="<?php echo $ingresos['fkIdPaciente']; ?>">
                                        Abrir Modal
                                    </button>

                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="pacienteForm" method="POST" action="pacientes_emergente.php">
                                                        <input  name="fkIdPaciente" id="fkIdPaciente" type="hidden">
                                                        <div id="pacientes-content">
                                                            <?php include('pacientes_emergente.php'); ?>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="submit" style="background-color: transparent; border: none;"><i class="fas fa-search" style="color:blue;"></i></button>
                                <?php else: ?>
                                    <span>No disponible</span>
                                <?php endif; ?>

                                <a href="pacientes.php" title="Añadir nuevo ingreso a este paciente" style="color:green;" class="acciones"><i class="fa-solid fa-plus"></i></a>
                                <?php
                                if ($ingresos['egreso'] == 1) {
                                ?>
                                <?php
                                } else {
                                ?> <a href="pacientes.php" title="Registrar salida" style="color:gray;" class="acciones"><i class="fa-solid fa-right-from-bracket"></i></a>
                                <?php
                                }
                                ?>
                                <button type="submit" style="background-color: transparent; border: none;"><i class="fa-solid fa-trash" style="color:red;"></i></button>
                                <a href="../controladores/eliminar_ingreso.php?idIngreso=<? echo $ingresos['idIngreso']; ?>" title="Eliminar ingreso" style="color:red;" class="acciones"><i class="fa-solid fa-trash"></i></a>
                                <!-- <input type="text" class="forma-control" name="idPaciente" value="<?php //echo $ingresos['idIngreso']; 
                                                                                                        ?>"> -->
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#tabla_ingresos').DataTable();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('exampleModalCenter');
    modal.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget;
        const fkIdPaciente = button.getAttribute('data-fk-id-paciente');

        // Cargar contenido dinámicamente
        const modalBody = modal.querySelector('.modal-body #pacientes-content');
        modalBody.innerHTML = 'Cargando...';

        fetch('pacientes_emergente.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `fkIdPaciente=${fkIdPaciente}`
        })
        .then(response => response.text())
        .then(html => {
            modalBody.innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>

</body>

</html>