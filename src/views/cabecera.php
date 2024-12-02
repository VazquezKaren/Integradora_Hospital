<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Municipal del Niño</title>
    <link rel="icon" href="../../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../css/estilos.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/inicio.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/pacientes.css?v=<?php echo time(); ?>">
    <!--  ICONOS DE LA PLATAFORMA  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <!--  BOOTSTRAP5  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!--  Jquery  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!--  DataTable  -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">
    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--  Scripts locales  -->
    <script src="../../JS/main.js?v=<?php echo time(); ?>"></script>
    <script src="../../JS/funciones.js?v=<?php echo time(); ?>"></script>
    <script src="../../JS/alertas.js?v=<?php echo time(); ?>"></script>
    <script src="../../JS/manual.js"></script>
    <style>
        #miGrafica {
            width: 30px;
            /* Aumenta el tamaño para que sea visible */
            height: 20px;
        }
    </style>
</head>

<?php

include('../controladores/sesion.php');

?>

<body>
    <div class="loader-container">
        <div class="loader"></div>
    </div>


    <body>
        <header class="header">
            <div class="container">
                <div class="btn-menu">
                    <label for="btn-menu"><i class="fa-solid fa-bars"></i></label>
                </div>
                <div class="logo">
                    <a href="inicio.php" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
                        <img src="../uploads/logo.png" style="max-width: 100px; max-height: 50px;">
                        <h1 class="centered-h1">Hospital Municipal del Niño</h1>
                    </a>
                </div>
                <nav class="menu">
                    <a href="historial.php" class="user-link">
                        Historial <i class="fa-solid fa-clipboard"></i>
                    </a>
                    <a href="empleado.php" class="user-link">
                        <?php echo $_SESSION['nombreEmpleado']; ?> <i class="fas fa-user"></i>
                    </a>
                </nav>
            </div>
        </header>


        <input type="checkbox" id="btn-menu" checked>
        <div class="container-menu">
            <div class="cont-menu">



                <nav>
                    <div class="sidebar-content">
                        <a href="empleado.php" class="empleado"><i class="fas fa-user"></i> <?php echo $_SESSION['nombreEmpleado'] . ' ' . $_SESSION['apellidoPaternoEmpleado']; ?></a>

                        <!-- Elementos de la pagina de Trabajo social -->
                        <?php if ($privilegio == 'TRABAJO_SOCIAL') { ?>
                            <ul class="no-padding-menu">
                                <li class="list_item">
                                    <div class="list_button">
                                        <a href="../views/inicio.php" class="nav_link"><i class="fas fa-home"></i>Inicio</a>
                                    </div>
                                </li>

                                <li class="list_item list_item--click">
                                    <div class="list_button list_button--click">
                                        <a class="nav_link"><i class="fa-solid fa-hospital-user"></i>Pacientes<i class="fas fa-chevron-down arrow"></i></a>
                                    </div>
                                    <ul class="list_show">
                                        <li class="list_inside">
                                            <a href="registro.php" class="nav_link nav_link--inside"><i class="fas fa-user-plus"></i>Registrar paciente</a>
                                        </li>
                                        <li class="list_inside">
                                            <a href="pacientes.php" class="nav_link nav_link--inside"><i class="fas fa-search"></i>Consultar paciente</a>
                                        </li>
                                        <li class="list_inside">
                                            <a href="ingresos.php" class="nav_link nav_link--inside"><i class="fa-solid fa-arrow-right"></i>Ingresos</a>
                                        </li>

                                    </ul>
                                </li>


                                <li class="list_item">
                                    <div class="list_button">
                                        <a href="#" class="nav_link"><i class="fas fa-envelope"></i>Contacto</a>
                                    </div>
                                </li>
                            </ul>
                        <?php }; ?>


                        <!-- Elementos de la pagina de ADMIN -->
                        <?php if ($privilegio == 'ADMIN') { ?>
                            <ul class="no-padding-menu">
                                <li class="list_item">
                                    <div class="list_button">
                                        <a href="../views/inicio.php" class="nav_link"><i class="fas fa-home"></i>Inicio</a>
                                    </div>
                                </li>

                                <li class="list_item list_item--click">
                                    <div class="list_button list_button--click">
                                        <a class="nav_link"><i class="fas fa-briefcase"></i>Empleados<i class="fas fa-chevron-down arrow"></i></a>
                                    </div>
                                    <ul class="list_show">
                                        <li class="list_inside">
                                            <a href="registroEmpleado.php" class="nav_link nav_link--inside"><i class="fas fa-user-plus"></i>Registrar empleado</a>
                                        </li>
                                        <li class="list_inside">
                                            <a href="consultarEmpleado.php" class="nav_link nav_link--inside"><i class="fas fa-search"></i>Consultar empleado</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="list_item list_item--click">
                                    <div class="list_button list_button--click">
                                        <a class="nav_link"><i class="fa-solid fa-hospital-user"></i>Pacientes<i class="fas fa-chevron-down arrow"></i></a>
                                    </div>
                                    <ul class="list_show">
                                        <li class="list_inside">
                                            <a href="registro.php" class="nav_link nav_link--inside"><i class="fas fa-user-plus"></i>Registrar paciente</a>
                                        </li>
                                        <li class="list_inside">
                                            <a href="pacientes.php" class="nav_link nav_link--inside"><i class="fas fa-search"></i>Consultar paciente</a>
                                        </li>
                                        <li class="list_inside">
                                            <a href="ingresos.php" class="nav_link nav_link--inside"><i class="fa-solid fa-arrow-right"></i>Ingresos</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="list_item">
                                    <div class="list_button">
                                        <a href="configuracion.php" class="nav_link"><i class="fa-solid fa-gear"></i></i>Configuracion</a>
                                    </div>
                                </li>

                            </ul>
                        <?php }; ?>

                        <!-- Elementos de la pagina de ENFERMERA -->
                        <?php if ($privilegio == 'ENFERMERA') { ?>
                            <ul class="no-padding-menu">
                                <li class="list_item">
                                    <div class="list_button">
                                        <a href="../views/inicio.php" class="nav_link"><i class="fas fa-home"></i>Inicio</a>
                                    </div>
                                </li>

                                <li class="list_item list_item--click">
                                    <div class="list_button list_button--click">
                                        <a class="nav_link"><i class="fa-solid fa-hospital-user"></i>Pacientes<i class="fas fa-chevron-down arrow"></i></a>
                                    </div>
                                    <ul class="list_show">
                                        <li class="list_inside">
                                            <a href="registro.php" class="nav_link nav_link--inside"><i class="fas fa-user-plus"></i>Registrar paciente</a>
                                        </li>
                                        <li class="list_inside">
                                            <a href="pacientes.php" class="nav_link nav_link--inside"><i class="fas fa-search"></i>Consultar paciente</a>
                                        </li>
                                        <li class="list_inside">
                                            <a href="ingresos.php" class="nav_link nav_link--inside"><i class="fa-solid fa-arrow-right"></i>Ingresos</a>
                                        </li>
                                    </ul>
                                </li>


                                <li class="list_item">
                                    <div class="list_button">
                                        <a href="#" class="nav_link"><i class="fas fa-envelope"></i>Contacto</a>
                                    </div>
                                </li>
                            </ul>
                        <?php }; ?>


                        <!-- Elementos de la pagina de DOCTOR -->
                        <?php if ($privilegio == 'DOCTOR') { ?>
                            <ul class="no-padding-menu">
                                <li class="list_item">
                                    <div class="list_button">
                                        <a href="../views/inicio.php" class="nav_link"><i class="fas fa-home"></i>Inicio</a>
                                    </div>
                                </li>

                                <li class="list_item list_item--click">
                                    <div class="list_button list_button--click">
                                        <a class="nav_link"><i class="fa-solid fa-hospital-user"></i>Pacientes<i class="fas fa-chevron-down arrow"></i></a>
                                    </div>
                                    <ul class="list_show">
                                        <li class="list_inside">
                                            <a href="registro.php" class="nav_link nav_link--inside"><i class="fas fa-user-plus"></i>Registrar paciente</a>
                                        </li>
                                        <li class="list_inside">
                                            <a href="pacientes.php" class="nav_link nav_link--inside"><i class="fas fa-search"></i>Consultar paciente</a>
                                        </li>
                                        <li class="list_inside">
                                            <a href="ingresos.php" class="nav_link nav_link--inside"><i class="fa-solid fa-arrow-right"></i>Ingresos</a>
                                        </li>
                                    </ul>
                                </li>


                                <li class="list_item">
                                    <div class="list_button">
                                        <a href="#" class="nav_link"><i class="fas fa-envelope"></i>Contacto</a>
                                    </div>
                                </li>
                            </ul>
                        <?php }; ?>
                    </div>
                </nav>


                <button class="cerrar-sesion" id="btn-logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</button>
                <!-- <a href="../controladores/CerrarSesion.php" class="cerrar-sesion" id="btn-logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a> -->
            </div>
        </div>
        
        <!-- CREACION DE LA VENTANA MODAL PARA REGISTRAR UN INGRESO EN CUALQUIER LUGAR DE LA PAGINA -->
        <button id="newAdmissionBtn" class="btn btn-primary position-fixed bottom-0 end-0 m-4" data-bs-toggle="modal" data-bs-target="#newAdmissionModal">
            <i class="fas fa-plus"></i> Nuevo Ingreso
        </button>
        <div class="modal fade" id="newAdmissionModal" tabindex="-1" aria-labelledby="newAdmissionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newAdmissionModalLabel">Registrar Nuevo Ingreso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                            <?php include('Ventanas_Modales/ingresos_emergente.php')?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../../JS/alertas.js?v=<?php echo time(); ?>"></script>

</html>