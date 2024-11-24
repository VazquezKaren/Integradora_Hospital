<?php 
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES, MODIFICAR EN CASO DE CAMBIAR RUTAS DE LOCALIZACION DE LOS ARCHIVOS DEL PROYECTO
include('cabecera.php'); 
?>

        <section class="main-content">

            <!--<h1 class="page-title">Registro de Nuevo Paciente</h1> -->


            <div class="content-grid">
                <div class="contentbox patient-info">
                    <form action="../controladores/registrar_paciente.php" method="POST">
                        <h2>Datos del Paciente</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre">Nombre(s):</label>
                                <input type="text" id="nombre" name="nombre" required >
                            </div>
                            <div class="form-group">
                                <label for="apellido_paterno">Apellido Paterno:</label>
                                <input type="text" id="apellido_paterno" name="apellido_paterno" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido_materno">Apellido Materno:</label>
                                <input type="text" id="apellido_materno" name="apellido_materno" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="edad">Edad:</label>
                                <input type="number" id="edad" name="edad" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="sexo">Sexo:</label>
                                <select id="sexo" name="sexo" required>
                                    <option value="femenino">Femenino</option>
                                    <option value="masculino">Masculino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="servicio_solicitado">Servicio que solicita:</label>
                                <input type="text" id="servicio_solicitado" name="servicio_solicitado" required>
                            </div>
                            <div class="form-group">
                                <label for="motivo">Motivo:</label>
                                <input type="text" id="motivo" name="motivo" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                    <label for="paciente_pais">País</label>
                                    <select id="paciente_pais" name="paciente_pais"
                                        onchange="actualizarEstados('paciente')" required>
                                        <option value="" disabled selected>Seleccione un país</option>
                                        <option value="Mexico">México</option>
                                        <option value="Extranjero">Extranjero</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="paciente_estado">Estado</label>
                                <select id="paciente_estado" name="paciente_estado"
                                    onchange="actualizarMunicipios('paciente')" required>
                                    <option value="" disabled selected>Seleccione un estado</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="paciente_municipio">Municipio</label>
                                <select id="paciente_municipio" name="paciente_municipio" required>
                                    <option value="" disabled selected>Seleccione un municipio</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group">
                                <label for="diagnostico_inicial">Dx inicial:</label>
                                <textarea name="dx" id="dx" rows="3" required></textarea>
                            </div>
                        </div>
                        <hr>
                        <h3>Dirección</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="direccion_calle">Calle:</label>
                                <input type="text" id="direccion_calle" name="direccion_calle" required>
                            </div>
                            <div class="form-group">
                                <label for="direccion_numero">Número:</label>
                                <input type="number" id="direccion_numero" name="direccion_numero" required>
                            </div>
                            <div class="form-group">
                                <label for="direccion_colonia">Colonia o Fraccionamiento:</label>
                                <input type="text" id="direccion_colonia" name="direccion_colonia" required>
                            </div>
                        </div>

                        <hr>

                        <h2>Información del Responsable</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="responsable_nombre">Nombre(s):</label>
                                <input type="text" id="responsable_nombre" name="responsable_nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="responsable_apellido_paterno">Apellido Paterno:</label>
                                <input type="text" id="responsable_apellido_paterno"
                                    name="responsable_apellido_paterno" required>
                            </div>
                            <div class="form-group">
                                <label for="responsable_apellido_materno">Apellido Materno:</label>
                                <input type="text" id="responsable_apellido_materno"
                                    name="responsable_apellido_materno" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="parentesco">Parentesco:</label>
                                <select id="parentesco" name="parentesco" required>
                                    <option value="PADRE">PADRE</option>
                                    <option value="MADRE">MADRE</option>
                                    <option value="TUTOR_LEGAL">TUTOR_LEGAL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="tel" id="telefono" name="telefono" required>
                            </div>
                            <div class="form-group">
                                <label for="ocupacion">Ocupación:</label>
                                <input type="text" id="ocupacion" name="ocupacion" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="responsable_pais">País</label>
                                <select id="responsable_pais" name="responsable_pais" onchange="actualizarEstados('responsable')" required>
                                    <option value="" disabled selected>Seleccione un país</option>
                                    <option value="Mexico">México</option>
                                    <option value="Extranjero">Extranjero</option>
                                </select>
                            </div>
                            
                            <!-- Estado del Responsable -->
                            <div class="form-group">
                                <label for="responsable_estado">Estado</label>
                                <select id="responsable_estado" name="responsable_estado" onchange="actualizarMunicipios('responsable')" required>
                                    <option value="" disabled selected>Seleccione un estado</option>
                                </select>
                            </div>
                            
                            <!-- Municipio del Responsable -->
                            <div class="form-group">
                                <label for="responsable_municipio">Municipio</label>
                                <select id="responsable_municipio" name="responsable_municipio" required>
                                    <option value="" disabled selected>Seleccione un municipio</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <h3>Dirección del Responsable</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="responsable_direccion_calle">Calle:</label>
                                <input type="text" id="responsable_direccion_calle" name="responsable_direccion_calle" required>
                            </div>
                            <div class="form-group">
                                <label for="responsable_direccion_numero">Número:</label>
                                <input type="text" id="responsable_direccion_numero"
                                    name="responsable_direccion_numero" required>
                            </div>
                            <div class="form-group">
                                <label for="responsable_direccion_colonia">Colonia o Fraccionamiento:</label>
                                <input type="text" id="responsable_direccion_colonia"
                                    name="responsable_direccion_colonia" required>
                            </div>
                        </div>

                        <hr>

                        <h3>Trabajo social</h3>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="personas_hogar">No. de personas en el hogar:</label>
                                <input type="number" id="personas_hogar" name="personas_hogar" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="clasificacion_trabajo_social">Clasificación de trabajo social:</label>
                                <select id="clasificacion_trabajo_social" name="clasificacion_trabajo_social" required>
                                    <option value="SIN_APOYO">SIN_APOYO</option>
                                    <option value="BAJO_APOYO">BAJO_APOYO</option>
                                    <option value="MEDIO_APOYO">MEDIO_APOYO</option>
                                    <option value="ALTO_APOYO">ALTO_APOYO</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="personas_apoyo">Personas que apoyan al sostenimiento del hogar:</label>
                                <input type="number" id="personas_apoyo" min="0" name="personas_apoyo" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="indice_economico">Índice económico:</label>
                                <select id="indice_economico" name="indice_economico" required>
                                    <option value="BAJO">BAJO</option>
                                    <option value="MEDIO">MEDIO</option>
                                    <option value="ALTO">ALTO</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="derechohabiente">Derechohabiente a:</label>
                                <select id="derechohabiente" name="derechohabiente" required>
                                    <option value="IMSS">IMSS</option>
                                    <option value="ISSSTE">ISSSTE</option>
                                    <option value="SEDENA">SEDENA</option>
                                    <option value="Seguro Popular">Seguro Popular</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="derechohabiente_otro">Otro:</label>
                                <input type="text" id="derechohabiente_otro" name="derechohabiente_otro" required>
                            </div> -->
                        </div>
                        
                    


                        <div class="form-row">

                        </div>

                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="observaciones">Observaciones:</label>
                                <textarea id="observaciones" rows="5" name="observaciones" required></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="hoja_frontal">Hoja frontal:</label>
                                <input type="file" name="hoja_frontal" id="hoja_frontal">
                            </div>
                            <div class="form-group">
                                <label for="hoja_compromiso">Hoja de compromiso:</label>
                                <input type="file" name="hoja_compromiso" id="hoja_compromiso">
                            </div>
                        </div>

                        <div class="button-group">
                            <button type="button">Generar Hoja Frontal</button>
                            <button type="button">Generar Hoja de Compromiso</button>
                        </div>

                        <div class="button-group">
                            <button type="submit">Registrar Paciente</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </body>

</html>