<?php
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES, MODIFICAR EN CASO DE CAMBIAR RUTAS DE LOCALIZACION DE LOS ARCHIVOS DEL PROYECTO
include_once('cabecera.php');
include_once('../config.php');
include_once('../controladores/tabla_ingresos.php');
?>

<section class="main-content">
    <div class="content-grid">
        <div class="contentbox patient-info">
            <h1>Buscador</h1>
            <p>Ingrese el nombre del paciente o el numero del empleado que registro el ingreso o bien ajuste los filtros para buscar un ingreso</p>
            <hr>
            <form method="GET" action="ingresos.php">
                <div class="form-row">
                    <div class="form-group-filter">
                        <label>Nombre del paciente:</label>
                        <input type="text" placeholder="Nombre del paciente" name="buscar" id="buscar" value="<?php echo $_GET["buscar"] ?? ''; ?>">

                    </div>

                    <div class="form-group-filter">
                        <label>Numero del Empleado:</label>
                        <input type="text" placeholder="Numero del empleado" name="buscarempleado" id="buscarempleado" value="<?php echo $_GET["buscarempleado"] ?? ''; ?>">
                    </div>

                    <div class="form-group-filter">
                        <label>Estado del ingreso:</label>
                        <select name="estadoingreso" id="status-item" id="estadoingreso">
                            <?php if ($_GET["estadoingreso"] != '') { ?>
                                <option value="<?php echo $_GET["estadoingreso"] ?? ''; ?>"><?php echo $_GET["estadoingreso"] ?? ''; ?></option>
                            <?php } ?>
                            <option value="">Todos</option>
                            <option value="1">Dados de alta</option>
                            <option value="0">Internados</option>
                        </select>
                    </div>

                    <div class="form-group-filter" style="margin-left: 15px;">
                        <label>Turno de ingreso:</label>
                        <select name="turnoingreso" id="status-item" id="turnoingreso">
                            <?php if ($_GET["turnoingreso"] != '') { ?>
                                <option value="<?php echo $_GET["turnoingreso"] ?? ''; ?>"><?php echo $_GET["turnoingreso"] ?? ''; ?></option>
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
                            <?php if ($_GET["orden"] != '') { ?>
                                <option value="<?php echo $_GET["orden"] ?? ''; ?>"><?php echo $_GET["orden"] ?? ''; ?>
                                    <?php
                                    if ($_GET["orden"] == '1') {
                                        echo 'Ordenar por nombre';
                                    }
                                    if ($_GET["orden"] == '2') {
                                        echo 'Ordenar por fecha ingreso mas reciente';
                                    }
                                    if ($_GET["orden"] == '3') {
                                        echo 'Ordenar por fecha ingreso mas antigua';
                                    }
                                    if ($_GET["orden"] == '4') {
                                        echo 'Ordenar por hora ingreso mas reciente';
                                    }
                                    if ($_GET["orden"] == '5') {
                                        echo 'Ordenar por hora ingreso mas antigua';
                                    }
                                    if ($_GET["orden"] == '6') {
                                        echo 'Ordenar por fecha egreso reciente';
                                    }
                                    if ($_GET["orden"] == '7') {
                                        echo 'Ordenar por fecha egreso antigua';
                                    }
                                    if ($_GET["orden"] == '8') {
                                        echo 'Ordenar por hora egreso mas reciente';
                                    }
                                    if ($_GET["orden"] == '9') {
                                        echo 'Ordenar por hora egreso mas antigua';
                                    }
                                    if ($_GET["orden"] == '10') {
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
                        <input type="date" placeholder="Fecha de ingreso desde" name="buscarfechadesdeingreso" id="buscarfechadesdeingreso" style="margin-right: 50px;" value="<?php echo $_GET["buscarfechadesdeingreso"] ?? ''; ?>">
                    </div>

                    <div class="form-group-filter">
                        <label>Fecha hasta ingreso:</label>
                        <input type="date" placeholder="Fecha de ingreso hasta" name="buscarfechahastaingreso" id="buscarfechahastaingreso" style="margin-right: 50px;" value="<?php echo $_GET["buscarfechahastaingreso"] ?? ''; ?>">
                    </div>

                    <div class="form-group-filter">
                        <label>Fecha desde egreso:</label>
                        <input type="date" placeholder="Fecha de egreso desde" name="buscarfechadesdeegreso" id="buscarfechadesdeegreso" style="margin-right: 50px;" value="<?php echo $_GET["buscarfechadesdeegreso"] ?? ''; ?>">
                    </div>

                    <div class="form-group-filter">
                        <label>Fecha hasta egreso:</label>
                        <input type="date" placeholder="Fecha de hasta hasta" name="buscarfechahastaegreso" id="buscarfechahastaegreso" style="margin-right: 50px;" value="<?php echo $_GET["buscarfechahastaegreso"] ?? ''; ?>">
                    </div>
                </div>
                <hr>
                            <!-- BOTON PARA ERESETEAR LOS FILTROS -->
                <button type="submit">Buscar</button>
                <a href="ingresos.php" class="btn-reset">Eliminar filtros</a>
                                    
            </form>
        </div>
    </div>
</section>

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
                    foreach ($ingresos as $ingreso) {
                    ?>
                        <tr>
                            <td><?php echo $ingreso['fechaIngreso'] ?></td>
                            <td><?php echo $ingreso['horaIngreso'] ?></td>
                            <td><?php echo $ingreso['nombrePaciente'] . " " . $ingreso['apellidoPaternoPaciente'] . " " . $ingreso['apellidoMaternoPaciente'] ?></td>
                            <td><?php echo $ingreso['fechaEgreso'] ?></td>
                            <td><?php echo $ingreso['horaEgreso'] ?></td>
                            <td><?php
                                if ($ingreso['egreso'] == 1) {
                                ?> <i class="fa-solid fa-check"></i>
                                <?php
                                } else {
                                ?> <i class="fa-solid fa-xmark"></i>
                                <?php
                                }
                                ?></td>
                            <td><?php echo $ingreso['servicioSolicita'] ?></td>
                            <td><?php echo $ingreso['idEmpleado'] ?></td>
                            <td>
                                <?php if (isset($ingreso['fkIdPaciente'])): ?>
                                    <!-- Botón para abrir el modal -->
                                    <!-- <input type="text" class="forma-control" name="idPaciente" value="<?php echo $ingreso['fkIdPaciente']; ?>">
                                    <input type="text" class="forma-control" name="idPaciente" value="<?php echo $ingreso['idIngreso']; ?>"> -->
                                    <button title="Mas informacion" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" data-fk-id-paciente="<?php echo $ingreso['fkIdPaciente']; ?>"><i class="fa-solid fa-plus"></i></button>
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
                                if ($ingreso['egreso'] == 1) {
                                ?>
                                <?php
                                } else {
                                ?>
                                    <form method="post" action="../controladores/marcar_salida.php" class="form-marcar-salida">
                                        <input type="hidden" class="forma-control" name="idIngreso" value="<?php echo $ingreso['idIngreso']; ?>">
                                        <button title="Registrar salida" type="button" class="btn btn-primary btn-marcar-salida">
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                        </button>
                                    </form>
                                <?php
                                }
                                ?>
                                <?php if ($privilegio == 'ADMIN') { ?>
                                <form method="post" action="../controladores/eliminar_ingreso.php" class="form-eliminar-ingreso">
                                    <input type="hidden" class="forma-control" name="idIngreso" value="<?php echo $ingreso['idIngreso']; ?>">
                                    <button title="Eliminar ingreso" type="button" class="btn btn-primary btn-eliminar-ingreso">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                <?php }?>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <!-- Botón de página anterior -->
                    <li class="page-item <?php echo $pagina <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['pagina' => $pagina - 1])); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>


                    <!-- Enlaces a las páginas -->
                    <?php for ($i = 1; $i <= $paginas_totales; $i++): ?>
                        <li class="page-item <?php echo $i == $pagina ? 'active' : ''; ?>">
                            <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['pagina' => $i])); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>


                    <!-- Botón de página siguiente -->
                    <li class="page-item <?php echo $pagina >= $paginas_totales ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['pagina' => $pagina + 1])); ?>" aria-label="Next">
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