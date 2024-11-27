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
// if (!isset($_POST['buscarhoradesdeingreso'])) {
//     $_POST['buscarhoradesdeingreso'] = '';
// }
// if (!isset($_POST['buscarhorahastaingreso'])) {
//     $_POST['buscarhorahastaingreso'] = '';
// }
// if (!isset($_POST['buscarhoradesdeegreso'])) {
//     $_POST['buscarhoradesdeegreso'] = '';
// }
// if (!isset($_POST['buscarhorahastaegreso'])) {
//     $_POST['buscarhorahastaegreso'] = '';
// }
if (!isset($_POST['turnoingreso'])) {
    $_POST['turnoingreso'] = '';
}
?>



<section class="main-content">
    <div class="content-grid">
        <div class="contentbox patient-info">
            <h1>Buscador</h1>
            <p>Ingrese el nombre del paciente o el numero del empleado que registro el ingreso o bien ajuste los filtros para buscar un ingreso</p>
            <hr>
            <form method="POST" action="ingresos.php">
                <div class="form-row">
                    <div class="form-group-filter">
                        <label>Nombre del paciente:</label>
                        <input type="text" placeholder="Nombre del paciente" name="buscar" id="buscar" value="<?php echo $_POST["buscar"]; ?>">
                    </div>

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
                            <option value="1">Dados de alta</option>
                            <option value="0">Internados</option>
                        </select>
                    </div>

                    <div class="form-group-filter" style="margin-left: 15px;">
                        <label>Turno de ingreso:</label>
                        <select name="turnoingreso" id="status-item" id="turnoingreso">
                            <?php if ($_POST["turnoingreso"] != '') { ?>
                                <option value="<?php echo $_POST["turnoingreso"]; ?>"><?php echo $_POST["turnoingreso"]; ?></option>
                            <?php } ?>
                            <option value="">Todos</option>
                            <option value="MATUTINO">Turno Matutino</option>
                            <option value="VESPERTINO">Turno Vespertino</option>
                            <option value="NOCTURNO">Turno Nocturno</option>
                        </select>
                    </div>
                    
                    <div class="form-group-filter" style="margin-left: 15px;">
                        <label>Seleccione el orden:</label>
                        <select name="orden" id="status-item" id="orden" style="min-width: 300px;">
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
                <div class="form-row">
                    <div class="form-group-filter">
                        <h2>Filtrado por fechas</h2>
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

                <!-- FILTRADO POR HORA INGRESO Y EGRESO -->

                <!-- <div class="form-row">
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
                </div> -->

                <!-- CONTENIDO DE OTRA DISPOSICION -->

                <!-- <div class="form-row">
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
                            <option value="1">Dados de alta</option>
                            <option value="0">Internados</option>
                        </select>
                    </div>

                    <div class="form-group-filter" style="margin-left: 15px;">
                        <label>Turno de ingreso:</label>
                        <select name="turnoingreso" id="status-item" id="turnoingreso">
                            <?php if ($_POST["turnoingreso"] != '') { ?>
                                <option value="<?php echo $_POST["turnoingreso"]; ?>"><?php echo $_POST["turnoingreso"]; ?></option>
                            <?php } ?>
                            <option value="">Todos</option>
                            <option value="MATUTINO">Turno Matutino</option>
                            <option value="VESPERTINO">Turno Vespertino</option>
                            <option value="NOCTURNO">Turno Nocturno</option>
                        </select>
                    </div>
                </div> -->
                <!-- <hr>
                <div class="form-row">
                    <div class="form-group-filter">
                        <h2>Ordenar por</h2>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-filter">
                        <label>Seleccione el orden:</label>
                        <select name="orden" id="status-item" id="orden" style="min-width: 300px;">
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
                </div> -->

                <hr>

                <button type="submit">Buscar</button>
            </form>
        </div>
    </div>
</section>
<?php
include_once('../controladores/tabla_ingresos.php');
?>

<?php
// Número de registros por página
$registros_por_pagina = 10;

// Obtener la página actual desde la URL
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina - 1) * $registros_por_pagina;

// Calcular el total de páginas
$rowCount = count($ingresos);  // Ya tienes el total de registros en el array
$paginas_totales = ceil($rowCount / $registros_por_pagina);

// Obtener los ingresos para la página actual
$ingresos_pagina = array_slice($ingresos, $offset, $registros_por_pagina);
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
                    foreach ($ingresos_pagina as $ingresos) {
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
                                    <form method="post" action="../controladores/marcar_salida.php" class="form-marcar-salida">
                                        <input type="hidden" class="forma-control" name="idIngreso" value="<?php echo $ingresos['idIngreso']; ?>">
                                        <button title="Registrar salida" type="button" class="btn btn-primary btn-marcar-salida">
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                        </button>
                                    </form>
                                <?php
                                }
                                ?>
                                <form method="post" action="../controladores/eliminar_ingreso.php" class="form-eliminar-ingreso">
                                    <input type="hidden" class="forma-control" name="idIngreso" value="<?php echo $ingresos['idIngreso']; ?>">
                                    <button title="Eliminar ingreso" type="button" class="btn btn-primary btn-eliminar-ingreso">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
            <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center" >
                        <!-- Botón de página anterior -->
                        <li class="page-item <?php echo $pagina <= 1 ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <!-- Enlaces a las páginas -->
                        <?php for ($i = 1; $i <= $paginas_totales; $i++): ?>
                            <li class="page-item <?php echo $i == $pagina ? 'active' : ''; ?>">
                                <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Botón de página siguiente -->
                        <li class="page-item <?php echo $pagina >= $paginas_totales ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
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