<?php
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES
include('cabecera.php');
include('../controladores/mostrar_informacion_pacientes.php')
?>

<style>
    input:focus {
        outline: none;
    }
</style>

<input type="text" placeholder="Haz clic aquí">

<script src="../../JS/funciones.js"></script>


<section class="main-content">
    <div class="content-grid">
        <div class="contentbox patient-info">
            <h1>Información del paciente</h1>
            <p>Ingrese el CURP del paciente</p>
            <br>

            <?php if ($error): ?>
                <div class="error-message" style="color: red; font-weight: bold;">
                    <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <form method="post" action="">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar" name="busqueda" id="busqueda" value="<?php echo $_POST['busqueda'] ?? ''; ?>">
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
                            <label for="nombres">Nombre(s):</label>
                            <input type="text" name="nombres" id="nombres" value="<?php echo htmlspecialchars($data['paciente_nombres'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="apellidoPaterno">Apellido paterno:</label>
                            <input type="text" name="apellidoPaterno" id="apellidoPaterno" value="<?php echo htmlspecialchars($data['paciente_apellidoPaterno'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="apellidoMaterno">Apellido materno:</label>
                            <input type="text" name="apellidoMaterno" id="apellidoMaterno" value="<?php echo htmlspecialchars($data['paciente_apellidoMaterno'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $data['paciente_fechaNacimiento'] ?? ''; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="paciente_edad">Edad:</label>
                            <input type="text" name="paciente_edad" id="paciente_edad" value="<?php echo $data['paciente_edad'] ?? ''; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <select name="sexo" id="sexo" disabled selected>
                                <option value="" disabled selected>Seleccione el sexo</option>
                                <option value="masculino" <?php echo (isset($data['paciente_sexo']) && $data['paciente_sexo'] == 'MASCULINO') ? 'selected' : ''; ?>>Masculino</option>
                                <option value="femenino" <?php echo (isset($data['paciente_sexo']) && $data['paciente_sexo'] == 'FEMENINO') ? 'selected' : ''; ?>>Femenino</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="paciente_pais">País: </label>
                            <select id="paciente_pais" name="paciente_pais" onchange="actualizarEstados('paciente')" disabled required>
                                <option value="" disabled selected>Seleccione un país</option>
                                <option value="Mexico" <?php echo (isset($data['paciente_pais']) && $data['paciente_pais'] == 'Mexico') ? 'selected' : ''; ?>>MEXICO</option>
                                <option value="Extranjero" <?php echo (isset($data['paciente_pais']) && $data['paciente_pais'] == 'EXTRANJERO') ? 'selected' : ''; ?>>EXTRANJERO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="paciente_estado">Estado: </label>
                            <select id="paciente_estado" name="paciente_estado" onchange="actualizarMunicipios('paciente')" disabled required>
                                <option value="" disabled selected>Seleccione un estado</option>
                                <?php if (isset($data['paciente_estado']) && !empty($data['paciente_estado'])): ?>
                                    <option value="<?php echo $data['paciente_estado']; ?>" selected><?php echo $data['paciente_estado']; ?></option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="paciente_municipio">Municipio: </label>
                            <select id="paciente_municipio" name="paciente_municipio" disabled required>
                                <option value="" disabled selected>Seleccione un municipio</option>
                                <?php if (isset($data['paciente_municipio']) && !empty($data['paciente_municipio'])): ?>
                                    <option value="<?php echo $data['paciente_municipio']; ?>" selected><?php echo $data['paciente_municipio']; ?></option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group">
                            <label for="paciente_CURP">CURP: </label>
                            <input type="text" name="paciente_CURP" id="paciente_CURP" value="<?php echo $data['paciente_CURP'] ?? ''; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="no_registro">No.Registro:</label>
                            <input type="text" id="no_registro" name="no_registro" value="<?php echo $data['no_registro'] ?? ''; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <input type="text" id="status" name="status" value="<?php echo isset($data['paciente_status']) && $data['paciente_status'] == 1 ? 'ACTIVO' : ''; ?>" readonly>
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
                            <label for="servicio">Derechohabiente:</label>
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
<!-- 
                    <div class="button-group">
                        <button type="button">Observar hoja de consentimiento</button>
                    </div> -->

                    <div class="button-group" id="paciente">
                        <button type="button" class="delete-button" onclick="confirmarEliminacionPaciente()"><i class="fa-solid fa-trash"></i>  Eliminar paciente</button>
                        <button type="button" id="modificar-btn-paciente" onclick="habilitarEdicion('paciente')" style="background-color: #fea429;"><i class="fa-solid fa-pen"></i>  Modificar</button>
                        <button type="button" class="save-button" id="guardar-btn-paciente" style="display: none;" onclick="guardarCambios('paciente')"><i class="fa-solid fa-floppy-disk"></i>  Guardar cambios</button>
                        <button type="reset" class="delete-button" id="descartar-btn-paciente" style="display: none;" onclick="deshabilitarEdicion('paciente')"><i class="fa-solid fa-rotate-left"></i>  Descartar cambios</button>
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
                        <!-- País del Tutor -->
                        <div class="form-group">
                            <label for="tutor_pais">País</label>
                            <select id="tutor_pais" name="tutor_pais" onchange="actualizarEstados('tutor')" disabled required>
                                <option value="" disabled selected>Seleccione un país</option>
                                <option value="Mexico" <?php echo (isset($data['tutor_pais']) && strtoupper($data['tutor_pais']) == 'MEXICO') ? 'selected' : ''; ?>>MÉXICO</option>
                                <option value="Extranjero" <?php echo (isset($data['tutor_pais']) && strtoupper($data['tutor_pais']) == 'EXTRANJERO') ? 'selected' : ''; ?>>EXTRANJERO</option>
                            </select>
                        </div>

                        <!-- Estado del Tutor -->
                        <div class="form-group">
                            <label for="tutor_estado">Estado</label>
                            <select id="tutor_estado" name="tutor_estado" onchange="actualizarMunicipios('tutor')" disabled required>
                                <option value="" disabled selected>Seleccione un estado</option>
                                <?php if (isset($data['tutor_estado']) && !empty($data['tutor_estado'])): ?>
                                    <option value="<?php echo htmlspecialchars($data['tutor_estado'], ENT_QUOTES, 'UTF-8'); ?>" selected>
                                        <?php echo htmlspecialchars($data['tutor_estado'], ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!-- Municipio del Tutor -->
                        <div class="form-group">
                            <label for="tutor_municipio">Municipio</label>
                            <select id="tutor_municipio" name="tutor_municipio" disabled required>
                                <option value="" disabled selected>Seleccione un municipio</option>
                                <?php if (isset($data['tutor_municipio']) && !empty($data['tutor_municipio'])): ?>
                                    <option value="<?php echo htmlspecialchars($data['tutor_municipio'], ENT_QUOTES, 'UTF-8'); ?>" selected>
                                        <?php echo htmlspecialchars($data['tutor_municipio'], ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
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
                            <input type="number" name="personas_hogar" id="personas_hogar" min="1" value="<?php echo $data['tutor_noPersonasHogar'] ?? ''; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="personas_apoyo">Personas que apoyan al sostenimiento del hogar:</label>
                            <input type="number" name="personas_apoyo" id="personas_apoyo" min="0" value="<?php echo $data['tutor_noPersonasApoyanEconomiaHogar'] ?? ''; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="trabajo_social">Trabajo social:</label>
                            <input type="text" name="trabajo_social" id="trabajo_social" value="<?php echo $data['trabajo_social'] ?? ''; ?>" disabled>
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

                    <div class="button-group" id="responsable">
                        <button type="button" id="modificar-btn-responsable" onclick="habilitarEdicion('responsable')"style="background-color: #fea429;"><i class="fa-solid fa-pen"></i>  Modificar</button>
                        <button type="button" class="save-button" id="guardar-btn-responsable" style="display: none;" onclick="guardarCambios('responsable')"><i class="fa-solid fa-floppy-disk"></i>  Guardar cambios</button>
                        <button type="reset" class="delete-button" id="descartar-btn-responsable" style="display: none;" onclick="deshabilitarEdicion('responsable')"><i class="fa-solid fa-rotate-left"></i>  Descartar cambios</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


</body>

</html>


</script>
</body>

</html>