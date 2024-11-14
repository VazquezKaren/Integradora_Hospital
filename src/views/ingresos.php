<?php 
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES, MODIFICAR EN CASO DE CAMBIAR RUTAS DE LOCALIZACION DE LOS ARCHIVOS DEL PROYECTO
include('cabecera.php'); 
include('../controladores/tabla_ingresos.php')
?>

    <section class="main-content">
        <div class="content-grid">
            <div class="contentbox patient-info">
                <h1>Buscar ingresos</h1>
                <p>Ingrese el No.de registro del paciente</p>
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
                            <th>IdIngreso</th>
                            <th>IdPaciente</th>
                            <th>Paciente</th>
                            <th>Fecha Ingreso</th>
                            <th>Hora Ingreso</th>
                            <th>Fecha Egreso</th>
                            <th>Hora Egreso</th>
                            <th>Egreso</th>
                            <th>Motivo</th>
                            <th>Servicio Solicitado</th>
                            <th>IdEmpleado</th>
                            <th>Empleado Responsable</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        foreach ($ingresos as $ingresos) {
                            ?>
                        <tr>
                            <td><?php echo $ingresos['idIngreso']?></td>
                            <td><?php echo $ingresos['fkIdPaciente']?></td>
                            <td><?php echo $ingresos['nombrePaciente']?></td>
                            <td><?php echo $ingresos['fechaIngreso']?></td>
                            <td><?php echo $ingresos['horaIngreso']?></td>
                            <td><?php echo $ingresos['fechaEgreso']?></td>
                            <td><?php echo $ingresos['horaEgreso']?></td>
                            <td><?php echo $ingresos['egreso']?></td>
                            <td><?php echo $ingresos['motivo']?></td>
                            <td><?php echo $ingresos['servicioSolicita']?></td>
                            <td><?php echo $ingresos['idEmpleado']?></td>
                            <td><?php echo $ingresos['nombreEmpleado']?></td>
                        </tr>
                        <?php }?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>