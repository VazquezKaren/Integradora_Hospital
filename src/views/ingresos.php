<?php
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES, MODIFICAR EN CASO DE CAMBIAR RUTAS DE LOCALIZACION DE LOS ARCHIVOS DEL PROYECTO
include_once('cabecera.php');
include_once('../config.php');
?>

<?php
if (!isset($_POST['buscar'])) {
    $_POST['buscar'] = '';
}
if (!isset($_POST['buscarfechadesdeingreso'])) {
    $_POST['buscarfechadesdeingreso'] = '';
}
if (!isset($_POST['buscarfechahastaingreso'])) {
    $_POST['buscarfechahastaingreso'] = '';
}
if (!isset($_POST['buscarfechadesdeegreso'])) {
    $_POST['buscarfechadesdeegreso'] = '';
}
if (!isset($_POST['buscarfechahastaegreso'])) {
    $_POST['buscarfechahastaegreso'] = '';
}
if (!isset($_POST['estadoingreso'])) {
    $_POST['estadoingreso'] = '';
}
if (!isset($_POST['orden'])) {
    $_POST['orden'] = '';
}
if (!isset($_POST['buscarempleado'])) {
    $_POST['buscarempleado'] = '';
}
if (!isset($_POST['buscarhoradesdeingreso'])) {
    $_POST['buscarhoradesdeingreso'] = '';
}
if (!isset($_POST['buscarhorahastaingreso'])) {
    $_POST['buscarhorahastaingreso'] = '';
}
if (!isset($_POST['buscarhoradesdeegreso'])) {
    $_POST['buscarhoradesdeegreso'] = '';
}
if (!isset($_POST['buscarhorahastaegreso'])) {
    $_POST['buscarhorahastaegreso'] = '';
}
?>



<section class="main-content">
    <div class="content-grid">
        <div class="contentbox patient-info">
            <h1>Buscador</h1>
            <p>Ingrese el nombre o ajuste los filtros para buscar un ingreso</p>
            <hr>
            <form method="POST" action="ingresos.php">
                <div class="form-row">
                    <div class="form-group">
                        <label>Nombre del paciente:</label>
                        <input type="text" placeholder="Nombre del paciente" name="buscar" id="buscar" value="<?php echo $_POST["buscar"]; ?>">
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group-filter">
                        <h2>Filtros</h2>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group-filter">
                        <label>Fecha desde ingreso:</label>
                        <input type="date" placeholder="Fecha de ingreso desde" name="buscarfechadesdeingreso" id="buscarfechadesdeingreso" style="margin-right: 50px;" value="<?php echo $_POST["buscarfechadesdeingreso"]; ?>">
                    </div>

                    <div class="form-group-filter">
                        <label>Fecha hasta ingreso:</label>
                        <input type="date" placeholder="Fecha de ingreso hasta" name="buscarfechahastaingreso" id="buscarfechahastaingreso" style="margin-right: 50px;" value="<?php echo $_POST["buscarfechahastaingreso"]; ?>">
                    </div>

                    <div class="form-group-filter">
                        <label>Fecha desde egreso:</label>
                        <input type="date" placeholder="Fecha de egreso desde" name="buscarfechadesdeegreso" id="buscarfechadesdeegreso" style="margin-right: 50px;" value="<?php echo $_POST["buscarfechadesdeegreso"]; ?>">
                    </div>

                    <div class="form-group-filter">
                        <label>Fecha hasta egreso:</label>
                        <input type="date" placeholder="Fecha de hasta hasta" name="buscarfechahastaegreso" id="buscarfechahastaegreso" style="margin-right: 50px;" value="<?php echo $_POST["buscarfechahastaegreso"]; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-filter">
                        <label>Hora desde ingreso:</label>
                        <input type="time" name="buscarhoradesdeingreso" id="buscarhoradesdeingreso" style="margin-right: 81px;" min="00:00" max="23:59" value="<?php echo isset($_POST['buscarhoradesdeingreso']) ? $_POST['buscarhoradesdeingreso'] : ''; ?>">
                    </div>

                    <div class="form-group-filter">
                        <label>Hora hasta ingreso:</label>
                        <input type="time" name="buscarhorahastaingreso" id="buscarhorahastaingreso" style="margin-right: 81px;" min="00:00" max="23:59" value="<?php echo isset($_POST['buscarhorahastaingreso']) ? $_POST['buscarhorahastaingreso'] : ''; ?>">
                    </div>

                    <div class="form-group-filter">
                        <label>Hora desde egreso:</label>
                        <input type="time" name="buscarhoradesdeegreso" id="buscarhoradesdeegreso" style="margin-right: 81px;" min="00:00" max="23:59" value="<?php echo isset($_POST['buscarhoradesdeegreso']) ? $_POST['buscarhoradesdeegreso'] : ''; ?>">
                    </div>

                    <div class="form-group-filter">
                        <label>Hora hasta egreso:</label>
                        <input type="time" name="buscarhorahastaegreso" id="buscarhorahastaegreso" style="margin-right: 81px;" min="00:00" max="23:59" value="<?php echo isset($_POST['buscarhorahastaegreso']) ? $_POST['buscarhorahastaegreso'] : ''; ?>">
                    </div>
                </div>



                <div class="form-row">
                    <div class="form-group-filter">
                        <label>Numero del Empleado:</label>
                        <input type="text" placeholder="Numero del empleado" name="buscarempleado" id="buscarempleado" value="<?php echo $_POST["buscarempleado"]; ?>">
                    </div>

                    <div class="form-group-filter">
                        <label>Estado del ingreso:</label>
                        <select name="estadoingreso" id="status-item" id="estadoingreso">
                            <?php if ($_POST["estadoingreso"] != '') { ?>
                                <option value="<?php echo $_POST["estadoingreso"]; ?>"><?php echo $_POST["estadoingreso"]; ?></option>
                            <?php } ?>
                            <option value="">Todos</option>
                            <option value="1">Egresados</option>
                            <option value="0">No egresados</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group-filter">
                        <h2>Ordenar por</h2>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-filter">
                        <label>Seleccione el orden:</label>
                        <select name="orden" id="status-item" id="orden" style="min-width: 350px;">
                            <?php if ($_POST["orden"] != '') { ?>
                                <option value="<?php echo $_POST["orden"]; ?>"><?php echo $_POST["orden"]; ?>
                                    <?php
                                    if ($_POST["orden"] == '1') {
                                        echo 'Ordenar por nombre';
                                    }
                                    if ($_POST["orden"] == '2') {
                                        echo 'Ordenar por fecha ingreso mas reciente';
                                    }
                                    if ($_POST["orden"] == '3') {
                                        echo 'Ordenar por fecha ingreso mas antigua';
                                    }
                                    if ($_POST["orden"] == '4') {
                                        echo 'Ordenar por hora ingreso mas reciente';
                                    }
                                    if ($_POST["orden"] == '5') {
                                        echo 'Ordenar por hora ingreso mas antigua';
                                    }
                                    if ($_POST["orden"] == '6') {
                                        echo 'Ordenar por fecha egreso reciente';
                                    }
                                    if ($_POST["orden"] == '7') {
                                        echo 'Ordenar por fecha egreso antigua';
                                    }
                                    if ($_POST["orden"] == '8') {
                                        echo 'Ordenar por hora egreso mas reciente';
                                    }
                                    if ($_POST["orden"] == '9') {
                                        echo 'Ordenar por hora egreso mas antigua';
                                    }
                                    if ($_POST["orden"] == '10') {
                                        echo 'Ordenar por servicio solicitado';
                                    }
                                    ?>
                                </option>
                            <?php } ?>
                            <option value="">Sin orden</option>
                            <option value="1">Ordenar por nombre</option>
                            <option value="2">Ordenar por fecha ingreso mas reciente</option>
                            <option value="3">Ordenar por fecha ingreso mas antigua</option>
                            <option value="4">Ordenar por hora ingreso mas reciente</option>
                            <option value="5">Ordenar por hora ingreso mas antigua</option>
                            <option value="6">Ordenar por fecha egreso reciente</option>
                            <option value="7">Ordenar por fecha egreso antigua</option>
                            <option value="8">Ordenar por hora egreso mas reciente</option>
                            <option value="9">Ordenar por hora egreso mas antigua</option>
                            <option value="10">Ordenar por servicio solicitado</option>
                        </select>
                    </div>
                </div>

                <hr>

                <button type="submit">Buscar</button>
            </form>
        </div>
    </div>
</section>
<?php
include_once('../controladores/tabla_ingresos.php');
?>
<section class="main-content">
    <div class="content-grid">
        <div class="contentbox patient-info">
            <p><?php echo $rowCount ?> Resultados encontrados</p>
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
                        <!-- <th>Motivo</th> -->
                        <th>Servicio Solicitado</th>
                        <th>No.Empleado</th>
                        <!-- <th>Empleado Responsable</th> -->
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
                            <td><?php echo $ingresos['servicioSolicita'] ?></td>
                            <td><?php echo $ingresos['idEmpleado'] ?></td>
                            <td>
                                <?php if (isset($ingresos['fkIdPaciente'])): ?>
                                    <!-- Botón para abrir el modal -->
                                    <!-- <input type="text" class="forma-control" name="idPaciente" value="<?php echo $ingresos['fkIdPaciente']; ?>">
                                    <input type="text" class="forma-control" name="idPaciente" value="<?php echo $ingresos['idIngreso']; ?>"> -->
                                    <button title="Mas informacion" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" data-fk-id-paciente="<?php echo $ingresos['fkIdPaciente']; ?>"><i class="fa-solid fa-plus"></i></button>
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Informacion del paciente</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <input name="fkIdPaciente" id="fkIdPaciente" type="hidden">
                                                    <div id="pacientes-content">
                                                        <?php include('pacientes_emergente.php'); ?>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <span>No disponible</span>
                                <?php endif; ?>
                                <?php
                                if ($ingresos['egreso'] == 1) {
                                ?>
                                <?php
                                } else {
                                ?>
                                    <form method="post" action="../controladores/marcar_salida.php" onsubmit="return confirm('¿Estás seguro de que deseas marcar la salida a este ingreso?');">
                                        <input type="hidden" class="forma-control" name="idIngreso" value="<?php echo $ingresos['idIngreso']; ?>">
                                        <button title="Registrar salida" type="submit" class="btn btn-primary"><i class="fa-solid fa-right-from-bracket"></i></button>
                                    </form>
                                <?php
                                }
                                ?>
                                <form method="post" action="../controladores/eliminar_ingreso.php" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este ingreso?');">
                                    <input type="hidden" class="forma-control" name="idIngreso" value="<?php echo $ingresos['idIngreso']; ?>">
                                    <button title="Eliminar ingreso" type="submit" class="btn btn-primary"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</section>


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
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
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