<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital del niño - Registro de Pacientes</title>
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/inicio.css">
    <link rel="stylesheet" href="../../css/pacientes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="JS/main.js"></script>
</head>

<body>
	<!-- <div class="loader-container">
        <div class="loader"></div>
    </div> -->

<body>
    <header class="header">
        <div class="container">
            <div class="btn-menu">
                <label for="btn-menu"><i class="fa-solid fa-bars"></i></label>
            </div>
            <div class="logo">
                <a href="inicio.html" style="text-decoration: none; color: inherit;">
                    <h1>Hospital del niño</h1>
                </a>
            </div>
            <nav class="menu">
                <a href="historial.html" class="user-link">
                    Historial <i class="fa-solid fa-clipboard"></i>
                </a>
                <a href="empleado.html" class="user-link">
                    Ricardo Perez <i class="fas fa-user"></i>
                </a>
            </nav>
        </div>
    </header>

    <div class="capa"></div>
    <input type="checkbox" id="btn-menu" checked>
    <div class="container-menu">
        <div class="cont-menu">
            <nav>
                <a href="empleado.html" class="empleado"><i class="fas fa-user"></i> Ricardo Perez</a>
                <a href="inicio.html" class="normal"><i class="fas fa-home"></i> Inicio</a>
                <a href="registro.html" class="normal"><i class="fas fa-user-plus"></i> Registrar nuevo paciente</a>
                <a href="pacientes.html" class="normal"><i class="fas fa-search"></i> Buscar paciente</a>
                <a href="formatoblanco.html" class="normal"><i class="fas fa-file-alt"></i> Formato en blanco</a>
            </nav>
            <a href="#" class="cerrar-sesion"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
        </div>
    </div>
    
    <section class="main-content">

        <!--<h1 class="page-title">Registro de Nuevo Paciente</h1> -->


        <div class="content-grid">
            <div class="contentbox patient-info">
                <form method="POST" action="/integradoraHospital/Integradora_Hospital/src/controladores/registrar_paciente.php" >
                    <h2>Datos del Paciente</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre(s):</label>
                            <input type="text" id="nombre" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellido_paterno">Apellido Paterno:</label>
                            <input type="text" id="apellido_paterno" name="apellido_paterno">
                        </div>
                        <div class="form-group">
                            <label for="apellido_materno">Apellido Materno:</label>
                            <input type="text" id="apellido_materno" name="apellido_materno">
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edad">Edad:</label>
                            <input type="number" id="edad" name="edad" min="0">
                        </div>
                        <div class="form-group">
                            <label for="lugar_nacimiento">Lugar de nacimiento:</label>
                            <input type="text" id="lugar_nacimiento" name="lugar_nacimiento">
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <select id="sexo" name="sexo">
                                <option value="femenino">Femenino</option>
                                <option value="masculino">Masculino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="servicio_solicitado">Servicio que solicita:</label>
                            <input type="text" id="servicio_solicitado" name="servicio_solicitado">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="diagnostico_inicial">Dx inicial:</label>
                            <textarea name="dx_registro" id="dx" rows="3" name="dx_registro"></textarea>
                        </div>
                    </div>
                    <hr>
                    <h3>Dirección</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="direccion_calle">Calle:</label>
                            <input type="text" id="direccion_calle" name="direccion_calle">
                        </div>
                        <div class="form-group">
                            <label for="direccion_numero">Número:</label>
                            <input type="number" id="direccion_numero" name="direccion_numero">
                        </div>
                        <div class="form-group">
                            <label for="direccion_colonia">Colonia o Fraccionamiento:</label>
                            <input type="text" id="direccion_colonia" name="direccion_colonia">
                        </div>
                    </div>
                
                    <hr>

                    <h2>Información del Responsable</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="responsable_nombre">Nombre(s):</label>
                            <input type="text" id="responsable_nombre" name="responsable_nombre">
                        </div>
                        <div class="form-group">
                            <label for="responsable_apellido_paterno">Apellido Paterno:</label>
                            <input type="text" id="responsable_apellido_paterno" name="responsable_apellido_paterno">
                        </div>
                        <div class="form-group">
                            <label for="responsable_apellido_materno">Apellido Materno:</label>
                            <input type="text" id="responsable_apellido_materno" name="responsable_apellido_materno">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="parentesco">Parentesco:</label>
                            <input type="text" id="parentesco" name="parentesco">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" id="telefono" name="telefono">
                        </div>
                        <div class="form-group">
                            <label for="ocupacion">Ocupación:</label>
                            <input type="text" id="ocupacion" name="ocupacion">
                        </div>
                    </div>

                        <hr>

                    <h3>Dirección del Responsable</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="responsable_direccion_calle">Calle:</label>
                            <input type="text" id="responsable_direccion_calle" name="responsable_direccion_calle">
                        </div>
                        <div class="form-group">
                            <label for="responsable_direccion_numero">Número:</label>
                            <input type="text" id="responsable_direccion_numero" name="responsable_direccion_numero">
                        </div>
                        <div class="form-group">
                            <label for="responsable_direccion_colonia">Colonia o Fraccionamiento:</label>
                            <input type="text" id="responsable_direccion_colonia" name="responsable_direccion_colonia">
                        </div>
                    </div>

                    <hr>

                    <h3>Trabajo social</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="personas_hogar">No. de personas en el hogar:</label>
                            <input type="number" id="personas_hogar" name="personas_hogar" min="0">
                        </div>
                        <div class="form-group">
                            <label for="clasificacion_trabajo_social">Clasificación de trabajo social:</label>
                            <input type="text" id="clasificacion_trabajo_social" name="clasificacion_trabajo_social">
                        </div>
                        <div class="form-group">
                            <label for="personas_apoyo">Personas que apoyan al sostenimiento del hogar:</label>
                            <input type="number" id="personas_apoyo" min="0" name="personas_apoyo">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="indice_economico">Índice económico:</label>
                            <input type="number" id="indice_economico" min="0" name="indice_economico">
                        </div>

                        <div class="form-group">
                            <label for="derechohabiente">Derechohabiente a:</label>
                            <select id="derechohabiente" name="derechohabiente">
                                <option value="IMSS">IMSS</option>
                                <option value="ISSSTE">ISSSTE</option>
                                <option value="SEDENA">SEDENA</option>
                                <option value="Seguro Popular">Seguro Popular</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="derechohabiente_otro">Otro:</label>
                            <input type="text" id="derechohabiente_otro" name="derechohabiente_otro">
                        </div>
                    </div>
                    <!--
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ingresos">Total de ingresos:</label>
                            <input type="number" id="ingresos" min="0">
                        </div>
                        <div class="form-group">
                            <label for="egresos">Total de egresos:</label>
                            <input type="number" id="egresos" min="0">
                        </div>
                    </div>
                    -->


                    <div class="form-row">
                        
                    </div>

                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="observaciones">Observaciones:</label>
                            <textarea id="observaciones" rows="5" name="observaciones"></textarea>
                        </div>
                    </div>
                    <!-- <div class="form-row">
                        <div class="form-group">
                            <label for="hoja_frontal">Hoja frontal:</label>
                            <input type="file" name="hoja_frontal" id="hoja_frontal">
                        </div>
                        <div class="form-group">
                            <label for="hoja_compromiso">Hoja de compromiso:</label>
                            <input type="file" name="hoja_compromiso" id="hoja_compromiso">
                        </div>
                    </div> -->

                    <div class="button-group">
                        <button type="button">Generar Hoja Frontal</button>
                        <button type="button">Generar Hoja de Compromiso</button>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit" name="registrar">Registrar Paciente</button>
                    </div>
                </form>
                <?php
                    // include("C:/Users/user/Desktop/integradoraHospital/Integradora_Hospital/src/controladores/registrar_paciente.php");
                ?>
            </div>
        </div>
    </section>

    <script>
        function toggleMenu() {
            document.body.classList.toggle('menu-closed');
        }

        // Asegúrate de que el menú esté abierto por defecto
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.remove('menu-closed');
        });
    </script>
</body>
</html>