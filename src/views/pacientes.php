<?php 
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES, MODIFICAR EN CASO DE CAMBIAR RUTAS DE LOCALIZACION DE LOS ARCHIVOS DEL PROYECTO
include('cabecera.php'); 
?>




    <section class="main-content">
        <div class="content-grid">
            <div class="contentbox patient-info">
                <h1>Informacion del paciente</h1>
                <p>Ingrese el No.de registro del paciente</p>
                <br>
                <i class="fa-solid fa-magnifying-glass"></i> <input type="text" placeholder="Buscar" name="busqueda">
                <button>Buscar</button>
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
                                <input type="text" name="nombre" id="nombre">
                            </div>
                            <div class="form-group">
                                <label for="apellido_p">Apellido paterno:</label>
                                <input type="text" name="apellido_p" id="apellido_p">
                            </div>
                            <div class="form-group">
                                <label for="apellido_m">Apellido materno:</label>
                                <input type="text" name="apellido_m" id="apellido_m">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento">
                            </div>
                            <div class="form-group">
                                <label for="sexo">Sexo:</label>
                                <select name="sexo" id="sexo">
                                    <option value="" disabled selected>Seleccione el sexo</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="paciente_pais">País</label>
                                <select id="paciente_pais" name="paciente_pais"
                                    onchange="actualizarEstados('paciente')">
                                    <option value="" disabled selected>Seleccione un país</option>
                                    <option value="Mexico">México</option>
                                    <option value="Extranjero">Extranjero</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="paciente_estado">Estado</label>
                                <select id="paciente_estado" name="paciente_estado"
                                    onchange="actualizarMunicipios('paciente')">
                                    <option value="" disabled selected>Seleccione un estado</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="paciente_municipio">Municipio</label>
                                <select id="paciente_municipio" name="paciente_municipio">
                                    <option value="" disabled selected>Seleccione un municipio</option>
                                </select>
                            </div>
                        </div>
                        <hr>

                        <h2>Dirección</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="calle">Calle:</label>
                                <input type="text" name="calle" id="calle">
                            </div>
                            <div class="form-group">
                                <label for="numero">Número:</label>
                                <input type="number" name="numero" id="numero">
                            </div>
                            <div class="form-group">
                                <label for="colonia">Colonia o Fraccionamiento:</label>
                                <input type="text" name="colonia" id="colonia">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="servicio">Servicio que solicita:</label>
                                <select name="servicio" id="servicio">
                                    <option value="" disabled selected>Seleccione el servicio</option>
                                    <option value="cardiologia">Cardiología</option>
                                    <option value="pediatria">Pediatría</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="dx">Dx inicial:</label>
                                <textarea name="dx" id="dx" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="observaciones">Observaciones:</label>
                                <textarea name="observaciones" id="observaciones" rows="5"></textarea>
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
                            <button type="submit">Guardar cambios</button>
                            <button type="reset">Descartar cambios</button>
                        </div>
                    </form>
                </div>
                <div id="responsable" class="tab-content">




                    <h2>Datos del Responsable</h2>
                    <form action="">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre_responsable">Nombre(s):</label>
                                <input type="text" name="nombre_responsable" id="nombre_responsable">
                            </div>
                            <div class="form-group">
                                <label for="apellido_p_responsable">Apellido paterno:</label>
                                <input type="text" name="apellido_p_responsable" id="apellido_p_responsable">
                            </div>
                            <div class="form-group">
                                <label for="apellido_m_responsable">Apellido materno:</label>
                                <input type="text" name="apellido_m_responsable" id="apellido_m_responsable">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="parentesco">Parentesco:</label>
                                <input type="text" name="parentesco" id="parentesco">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="tel" name="telefono" id="telefono">
                            </div>
                            <div class="form-group">
                                <label for="ocupacion">Ocupación:</label>
                                <input type="text" name="ocupacion" id="ocupacion">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="responsable_pais">País</label>
                                <select id="responsable_pais" name="responsable_pais" onchange="actualizarEstados('responsable')">
                                    <option value="" disabled selected>Seleccione un país</option>
                                    <option value="Mexico">México</option>
                                    <option value="Extranjero">Extranjero</option>
                                </select>
                            </div>
                            
                            <!-- Estado del Responsable -->
                            <div class="form-group">
                                <label for="responsable_estado">Estado</label>
                                <select id="responsable_estado" name="responsable_estado" onchange="actualizarMunicipios('responsable')">
                                    <option value="" disabled selected>Seleccione un estado</option>
                                </select>
                            </div>
                            
                            <!-- Municipio del Responsable -->
                            <div class="form-group">
                                <label for="responsable_municipio">Municipio</label>
                                <select id="responsable_municipio" name="responsable_municipio">
                                    <option value="" disabled selected>Seleccione un municipio</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <h2>Dirección</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="calle_responsable">Calle:</label>
                                <input type="text" name="calle_responsable" id="calle_responsable">
                            </div>
                            <div class="form-group">
                                <label for="numero_responsable">Número:</label>
                                <input type="number" name="numero_responsable" id="numero_responsable">
                            </div>
                            <div class="form-group">
                                <label for="colonia_responsable">Colonia o Fraccionamiento:</label>
                                <input type="text" name="colonia_responsable" id="colonia_responsable">
                            </div>
                        </div>

                        <hr>

                        <h2>Trabajo social</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="personas_hogar">No. de personas en el hogar:</label>
                                <input type="number" name="personas_hogar" id="personas_hogar" min="1">
                            </div>

                            <div class="form-group">
                                <label for="personas_apoyo">Personas que apoyan al sostenimiento del hogar:</label>
                                <input type="number" name="personas_apoyo" id="personas_apoyo" min="0">
                            </div>

                            <div class="form-group">
                                <label for="derechohabiente">Derechohabiente a:</label>
                                <input type="text" name="derechohabiente" id="derechohabiente">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="ingresos">Total de ingresos:</label>
                                <input type="number" name="ingresos" id="ingresos" min="0" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="egresos">Total de egresos:</label>
                                <input type="number" name="egresos" id="egresos" min="0" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="indice_economico">Índice económico:</label>
                                <select name="indice_economico" id="indice_economico">
                                    <option value="bajo">Bajo</option>
                                    <option value="medio">Medio</option>
                                    <option value="alto">Alto</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="button-group">
                            <button type="submit">Guardar cambios</button>
                            <button type="reset">Descartar cambios</button>
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
    </script>
</body>
</html>