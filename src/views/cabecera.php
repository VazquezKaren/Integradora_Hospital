<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital del niño</title>
    <link rel="stylesheet" href="../../css/estilos.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/inicio.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/pacientes.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="../../JS/main.js?v=<?php echo time(); ?>"></script>
    <script src="../../JS/funciones.js?v=<?php echo time(); ?>"></script>
    <script src="../../JS/alertas.js?v=<?php echo time(); ?>"></script>
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
                    <a href="inicio.php" style="text-decoration: none; color: inherit;">
                        <h1>Hospital del niño</h1>
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

        <div class="capa"></div>
        <input type="checkbox" id="btn-menu" checked>
        <div class="container-menu">
            <div class="cont-menu">
                <nav>
                    <a href="empleado.php" class="empleado"><i class="fas fa-user"></i> <?php echo $_SESSION['nombreEmpleado'] . ' ' . $_SESSION['apellidoPaternoEmpleado']; ?></a>

                    <!-- Elementos de la pagina de Trabajo social -->
                    <?php if ($privilegio == 'TRABAJO_SOCIAL') { ?>
                        <ul>
                        <li class="list_item">
                            <div class="list_button">
                                <a href="../views/inicio.php" class="nav_link"><i class="fas fa-home"></i>Inicio</a>
                            </div>
                        </li>

                        <li class="list_item list_item--click">
                            <div class="list_button list_button--click">
                                <a href="#" class="nav_link"><i class="fa-solid fa-hospital-user"></i>Pacientes<i class="fas fa-chevron-down arrow"></i></a>
                            </div>
                            <ul class="list_show">
                                <li class="list_inside">
                                    <a href="registro.php" class="nav_link nav_link--inside"><i class="fas fa-user-plus"></i>Registrar paciente</a>
                                </li>
                                <li class="list_inside">
                                    <a href="pacientes.php" class="nav_link nav_link--inside"><i class="fas fa-search"></i>Consultar paciente</a>
                                </li>
                                <li class="list_inside">
                                    <a href="pacientes.php" class="nav_link nav_link--inside"><i class="fa-solid fa-arrow-right"></i>Ingresos</a>
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
                        <ul>
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
                                <a href="#" class="nav_link"><i class="fa-solid fa-hospital-user"></i>Pacientes<i class="fas fa-chevron-down arrow"></i></a>
                            </div>
                            <ul class="list_show">
                                <li class="list_inside">
                                    <a href="registro.php" class="nav_link nav_link--inside"><i class="fas fa-user-plus"></i>Registrar paciente</a>
                                </li>
                                <li class="list_inside">
                                    <a href="pacientes.php" class="nav_link nav_link--inside"><i class="fas fa-search"></i>Consultar paciente</a>
                                </li>
                                <li class="list_inside">
                                    <a href="pacientes.php" class="nav_link nav_link--inside"><i class="fa-solid fa-arrow-right"></i>Ingresos</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="list_item">
                            <div class="list_button">
                                <a href="#" class="nav_link"><i class="fas fa-chart-bar"></i>Estadísticas</a>
                            </div>
                        </li>

                        <li class="list_item">
                            <div class="list_button">
                                <a href="#" class="nav_link"><i class="fa-solid fa-bell"></i></i>Notificaciones</a>
                            </div>
                        </li>
                    </ul>
                    <?php }; ?>

                    <!-- Elementos de la pagina de ENFERMERA -->
                    <?php if ($privilegio == 'ENFERMERA') { ?>
                        <ul>
                        <li class="list_item">
                            <div class="list_button">
                                <a href="../views/inicio.php" class="nav_link"><i class="fas fa-home"></i>Inicio</a>
                            </div>
                        </li>

                        <li class="list_item list_item--click">
                            <div class="list_button list_button--click">
                                <a href="#" class="nav_link"><i class="fa-solid fa-hospital-user"></i>Pacientes<i class="fas fa-chevron-down arrow"></i></a>
                            </div>
                            <ul class="list_show">
                                <li class="list_inside">
                                    <a href="registro.php" class="nav_link nav_link--inside"><i class="fas fa-user-plus"></i>Registrar paciente</a>
                                </li>
                                <li class="list_inside">
                                    <a href="pacientes.php" class="nav_link nav_link--inside"><i class="fas fa-search"></i>Consultar paciente</a>
                                </li>
                                <li class="list_inside">
                                    <a href="pacientes.php" class="nav_link nav_link--inside"><i class="fa-solid fa-arrow-right"></i>Ingresos</a>
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
                        <ul>
                        <li class="list_item">
                            <div class="list_button">
                                <a href="../views/inicio.php" class="nav_link"><i class="fas fa-home"></i>Inicio</a>
                            </div>
                        </li>

                        <li class="list_item list_item--click">
                            <div class="list_button list_button--click">
                                <a href="#" class="nav_link"><i class="fa-solid fa-hospital-user"></i>Pacientes<i class="fas fa-chevron-down arrow"></i></a>
                            </div>
                            <ul class="list_show">
                                <li class="list_inside">
                                    <a href="registro.php" class="nav_link nav_link--inside"><i class="fas fa-user-plus"></i>Registrar paciente</a>
                                </li>
                                <li class="list_inside">
                                    <a href="pacientes.php" class="nav_link nav_link--inside"><i class="fas fa-search"></i>Consultar paciente</a>
                                </li>
                                <li class="list_inside">
                                    <a href="pacientes.php" class="nav_link nav_link--inside"><i class="fa-solid fa-arrow-right"></i>Ingresos</a>
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

                </nav>
                <a href="../controladores/CerrarSesion.php" class="cerrar-sesion"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
            </div>
        </div>
    </body>

</html>