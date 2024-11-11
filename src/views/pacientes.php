<?php 
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES, MODIFICAR EN CASO DE CAMBIAR RUTAS DE LOCALIZACION DE LOS ARCHIVOS DEL PROYECTO
include('cabecera.php'); 
include('../controladores/mostrar_informacion_pacientes.php')
?>




    <section class="main-content">
        <div class="content-grid">
            <div class="contentbox patient-info">
                <h1>Informacion del paciente</h1>
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
                <div class="tabs">
                    <button class="tab-btn active" onclick="showTab('paciente')">Paciente</button>
                    <button class="tab-btn" onclick="showTab('responsable')">Responsable</button>
                </div>
                <div id="paciente" class="tab-content active">
                    <h2>Datos personales del paciente</h2>
                    <form action="">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre">Nombre(s):</label>
                                <input type="text" name="nombre" id="nombre" value="<?php echo $data['paciente_nombres'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="apellido_p">Apellido paterno:</label>
                                <input type="text" name="apellido_p" id="apellido_p" value="<?php echo $data['paciente_apellidoPaterno'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="apellido_m">Apellido materno:</label>
                                <input type="text" name="apellido_m" id="apellido_m" value="<?php echo $data['paciente_apellidoMaterno'] ?? ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $data['paciente_fechaNacimiento'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="apellido_m">Edad:</label>
                                <input type="text" name="paciente_edad" id="[acoemte_edad" value="<?php echo $data['paciente_edad'] ?? ''; ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="sexo">Sexo:</label>
                                <select name="sexo" id="sexo" disabled selected>
                                    <option value="" disabled selected>Seleccione el sexo</option>
                                    <option value="masculino"<?php echo (isset($data['paciente_sexo']) && $data['paciente_sexo'] == 'MASCULINO') ? 'selected' : ''; ?>>Masculino</option>
                                    <option value="femenino"<?php echo (isset($data['paciente_sexo']) && $data['paciente_sexo'] == 'FEMENINO') ? 'selected' : ''; ?>>Femenino</option>
                                </select>
                            </div>


                        </div>

                        <div class="form-row">
                        <div class="form-group">
                                <label for="paciente_pais">País</label>
                                <select id="paciente_pais" name="paciente_pais"
                                    onchange="actualizarEstados('paciente')" disabled selected>
                                    <option value="" disabled selected>Seleccione un país</option>
                                    <option value="Mexico" <?php echo (isset($data['paciente_pais']) && $data['paciente_pais'] == 'Mexico') ? 'selected' : ''; ?>>México</option>
                                    <option value="Extranjero" <?php echo (isset($data['paciente_pais']) && $data['paciente_pais'] == 'Extranjero') ? 'selected' : ''; ?>>Extranjero</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="paciente_estado">Estado</label>
                                <select id="paciente_estado" name="paciente_estado"
                                    onchange="actualizarMunicipios('paciente')" disabled selected>
                                    <option value="" disabled selected>Seleccione un estado</option>
                                    <?php if (isset($data['paciente_estado']) && !empty($data['paciente_estado'])): ?>
                                    <option value="<?php echo $data['paciente_estado']; ?>" selected><?php echo $data['paciente_estado']; ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="paciente_municipio">Municipio</label>
                                <select id="paciente_municipio" name="paciente_municipio" disabled selected>
                                    <option value="" disabled selected>Seleccione un municipio</option>
                                    <?php if (isset($data['paciente_municipio']) && !empty($data['paciente_municipio'])): ?>
                                    <option value="<?php echo $data['paciente_municipio']; ?>" selected><?php echo $data['paciente_municipio']; ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <hr>

                        <h2>Dirección</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="calle">Calle:</label>
                                <input type="text" name="calle" id="calle" value="<?php echo $data['paciente_calleDireccion'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="numero">Número:</label>
                                <input type="text" name="numero" id="numero" value="<?php echo $data['paciente_numeroDireccion'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="colonia">Colonia o Fraccionamiento:</label>
                                <input type="text" name="colonia" id="colonia" value="<?php echo $data['paciente_coloniaDireccion'] ?? ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="servicio">Servicio que solicita:</label>
                                <input type="text" name="derechoHabiente" id="derechoHabiente" value="<?php echo $data['paciente_derechoHabiente'] ?? ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="dx">Dx inicial:</label>
                                <textarea name="dx" id="dx" rows="3" readonly><?php echo $data['paciente_dx'] ?? ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="observaciones">Observaciones:</label>
                                <textarea name="observaciones" id="observaciones" rows="5" readonly><?php echo $data['paciente_observaciones'] ?? ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="hoja_frontal">Hoja frontal:</label>
                                <input type="file" name="hoja_frontal" id="hoja_frontal" readonly>
                            </div>
                            <div class="form-group">
                                <label for="hoja_compromiso">Hoja de compromiso:</label>
                                <input type="file" name="hoja_compromiso" id="hoja_compromiso" readonly>
                            </div>
                        </div>

                        <div class="button-group">
                            <button type="button">Generar Hoja Frontal</button>
                            <button type="button">Generar Hoja de Compromiso</button>
                        </div>

                        
                        <div class="button-group">
                            <button type="button" id="modificar-btn" onclick="habilitarEdicion()">Modificar</button>
                            <button type="submit" id="guardar-btn" style="display: none;" onclick="deshabilitarEdicion()">Guardar cambios</button>
                            <button type="reset" id="descartar-btn" style="display: none;" onclick="deshabilitarEdicion()">Descartar cambios</button>
                        </div>
                    </form>
                </div>
                <div id="responsable" class="tab-content">




                    <h2>Datos del Responsable</h2>
                    <form action="">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre_responsable">Nombre(s):</label>
                                <input type="text" name="nombre_responsable" id="nombre_responsable" value="<?php echo $data['tutor_nombres'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="apellido_p_responsable">Apellido paterno:</label>
                                <input type="text" name="apellido_p_responsable" id="apellido_p_responsable" value="<?php echo $data['tutor_apellidoPaterno'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="apellido_m_responsable">Apellido materno:</label>
                                <input type="text" name="apellido_m_responsable" id="apellido_m_responsable" value="<?php echo $data['tutor_apellidoMaterno'] ?? ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="parentesco">Parentesco:</label>
                                <input type="text" name="parentesco" id="parentesco" value="<?php echo $data['tutor_parentesco'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="tel" name="telefono" id="telefono" value="<?php echo $data['tutor_telefono'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="ocupacion">Ocupación:</label>
                                <input type="text" name="ocupacion" id="ocupacion" value="<?php echo $data['tutor_ocupacion'] ?? ''; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="responsable_pais">País</label>
                                <select id="responsable_pais" name="responsable_pais" onchange="actualizarEstados('responsable')" disabled selected>
                                <option value="" disabled>Seleccione un país</option>
                                <option value="Mexico" <?php echo (isset($data['tutor_pais']) && $data['tutor_pais'] == 'Mexico') ? 'selected' : ''; ?>>México</option>
                                <option value="Extranjero" <?php echo (isset($data['tutor_pais']) && $data['tutor_pais'] == 'Extranjero') ? 'selected' : ''; ?>>Extranjero</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="responsable_estado">Estado</label>
                                <select id="responsable_estado" name="responsable_estado" onchange="actualizarMunicipios('responsable')" disabled selected>
                                    <option value="" disabled>Seleccione un estado</option>
                                    <?php if (isset($data['tutor_estado']) && !empty($data['tutor_estado'])): ?>
                                        <option value="<?php echo $data['tutor_estado']; ?>" selected><?php echo $data['tutor_estado']; ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="responsable_municipio">Municipio</label>
                                <select id="responsable_municipio" name="responsable_municipio" disabled selected>
                                    <option value="" disabled>Seleccione un municipio</option>
                                    <?php if (isset($data['tutor_municipio']) && !empty($data['tutor_municipio'])): ?>
                                        <option value="<?php echo $data['tutor_municipio']; ?>" selected><?php echo $data['tutor_municipio']; ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <h2>Dirección</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="calle_responsable">Calle:</label>
                                <input type="text" name="calle_responsable" id="calle_responsable" value="<?php echo $data['tutor_calleDireccion'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="numero_responsable">Número:</label>
                                <input type="text" name="numero_responsable" id="numero_responsable" value="<?php echo $data['tutor_numeroDireccion'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="colonia_responsable">Colonia o Fraccionamiento:</label>
                                <input type="text" name="colonia_responsable" id="colonia_responsable" value="<?php echo $data['tutor_coloniaDireccion'] ?? ''; ?>" readonly>
                            </div>
                        </div>

                        <hr>

                        <h2>Trabajo social</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="personas_hogar">No. de personas en el hogar:</label>
                                <input type="number" name="personas_hogar" id="personas_hogar" min="1" value="<?php echo $data['tutor_noPersonasHogar'] ?? ''; ?>" readonly >
                            </div>

                            <div class="form-group">
                                <label for="personas_apoyo">Personas que apoyan al sostenimiento del hogar:</label>
                                <input type="number" name="personas_apoyo" id="personas_apoyo" min="0" value="<?php echo $data['tutor_noPersonasApoyanEconomiaHogar'] ?? ''; ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="derechohabiente">Derechohabiente a:</label>
                                <input type="text" name="derechohabiente" id="derechohabiente" value="<?php echo $data['tutor_derechoHabiente'] ?? ''; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="ingresos">Total de ingresos:</label>
                                <input type="number" name="ingresos" id="ingresos" min="0" step="0.01" value="<?php echo $data['tutor_totalIngresos'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="egresos">Total de egresos:</label>
                                <input type="number" name="egresos" id="egresos" min="0" step="0.01" value="<?php echo $data['tutor_totalIngresos'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="indice_economico">Índice económico:</label>
                                <select name="indice_economico" id="indice_economico" disabled selected>
                                    <option value="bajo" <?php echo (isset($data['indiceEconomico']) && $data['indiceEconomico'] == 'BAJO') ? 'selected' : ''; ?>>Bajo</option>
                                    <option value="medio" <?php echo (isset($data['indiceEconomico']) && $data['indiceEconomico'] == 'MEDIO') ? 'selected' : ''; ?>>Medio</option>
                                    <option value="alto" <?php echo (isset($data['indiceEconomico']) && $data['indiceEconomico'] == 'ALTO') ? 'selected' : ''; ?>>Alto</option>
                            </select>
                            </div>
                        </div>
                       
                        <div class="button-group">
                            <button type="button" id="modificar-btn" onclick="habilitarEdicion()">Modificar</button>
                            <button type="submit" id="guardar-btn" style="display: none;" onclick="deshabilitarEdicion()">Guardar cambios</button>
                            <button type="reset" id="descartar-btn" style="display: none;" onclick="deshabilitarEdicion()">Descartar cambios</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        
        function showTab(tabName) {
            var tabs = document.getElementsByClassName("tab-content");
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].style.display = "none";
            }
            document.getElementById(tabName).style.display = "block";
            
            var buttons = document.getElementsByClassName("tab-btn");
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].classList.remove("active");
            }
            event.currentTarget.classList.add("active");
        }
        function habilitarEdicion() {
        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.removeAttribute('readonly');  
            input.removeAttribute('disabled');  
        });

        document.getElementById('guardar-btn').style.display = 'inline';
        document.getElementById('descartar-btn').style.display = 'inline';
        document.getElementById('modificar-btn').style.display = 'none';
    }

    function deshabilitarEdicion() {
     
        const inputs = document.querySelectorAll('input:not([name="busqueda"]), select, textarea');
        inputs.forEach(input => {
            input.setAttribute('readonly', true);  
            input.setAttribute('disabled', true);  
        });

        document.getElementById('guardar-btn').style.display = 'none';
        document.getElementById('descartar-btn').style.display = 'none';
        document.getElementById('modificar-btn').style.display = 'inline';
    }
    </script>
</body>
</html>