<?php
require_once '../config.php';

$data = [];

if (isset($_POST['fkIdPaciente'])) {
    $busqueda = $_POST['fkIdPaciente'];

    $sql = "SELECT 
        paciente.nombres AS paciente_nombres, 
        paciente.apellidoPaterno AS paciente_apellidoPaterno, 
        paciente.apellidoMaterno AS paciente_apellidoMaterno, 
        paciente.fechaNacimiento AS paciente_fechaNacimiento, 
        paciente.pais AS paciente_pais, 
        paciente.estado AS paciente_estado, 
        paciente.municipio AS paciente_municipio, 
        paciente.sexo AS paciente_sexo, 
        paciente.edad AS paciente_edad,
        paciente.calleDireccion AS paciente_calleDireccion, 
        paciente.numeroDireccion AS paciente_numeroDireccion, 
        paciente.coloniaDireccion AS paciente_coloniaDireccion,
        paciente.derechoHabiente AS paciente_derechoHabiente, 
        paciente.dx AS paciente_dx, 
        paciente.observaciones AS paciente_observaciones,
        tutor.nombres AS tutor_nombres, 
        tutor.apellidoPaterno AS tutor_apellidoPaterno, 
        tutor.apellidoMaterno AS tutor_apellidoMaterno, 
        tutor.parentesco AS tutor_parentesco, 
        tutor.telefono AS tutor_telefono, 
        tutor.ocupacion AS tutor_ocupacion,
        tutor.pais AS tutor_pais,
        tutor.estado AS tutor_estado,
        tutor.municipio AS tutor_municipio,
        tutor.calleDireccion AS tutor_calleDireccion,
        tutor.numeroDireccion AS tutor_numeroDireccion,
        tutor.coloniaDireccion AS tutor_coloniaDireccion,
        tutor.noPersonasHogar AS tutor_noPersonasHogar,
        tutor.noPersonasApoyanEconomiaHogar AS tutor_noPersonasApoyanEconomiaHogar,
        tutor.totalIngresos AS tutor_totalIngresos, 
        tutor.totalEgresos AS tutor_totalEgresos,
        tutor.indiceEconomico AS tutor_indiceEconomico
    FROM paciente
    LEFT JOIN tutor ON paciente.idPaciente = tutor.fkidPaciente
    WHERE paciente.idPaciente = :busqueda";

    $connObj = new conn();
    $conn = $connObj->connect();

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":busqueda", $busqueda, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}else {
    echo 'Usuario no encontrado';
}
?>


<section class="main-content">
    <div class="content-grid">
        <div class="contentbox patient-info">

        <div class="tabs">
                    <button class="tab-btn active" onclick="showTab('paciente')">Paciente</button>
                    <button class="tab-btn" onclick="showTab('responsable')">Responsable</button>
                    <button class="tab-btn" onclick="showTab('ingreosos')">Ingresos</button>
        </div>


            <div id="paciente" class="tab-content active">
                <h2>Datos personales del paciente</h2>
                <form action="">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre(s):</label>
                            <input type="text" name="nombre" id="nombre" value="<?php echo $data['paciente_nombres'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="apellido_p">Apellido paterno:</label>
                            <input type="text" name="apellido_p" id="apellido_p" value="<?php echo $data['paciente_apellidoPaterno'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="apellido_m">Apellido materno:</label>
                            <input type="text" name="apellido_m" id="apellido_m" value="<?php echo $data['paciente_apellidoMaterno'] ?? ''; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $data['paciente_fechaNacimiento'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="apellido_m">Edad:</label>
                            <input type="text" name="paciente_edad" id="[acoemte_edad" value="<?php echo $data['paciente_edad'] ?? ''; ?>" disabled>
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
                            <input type="text" name="calle" id="calle" value="<?php echo $data['paciente_calleDireccion'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="numero">Número:</label>
                            <input type="text" name="numero" id="numero" value="<?php echo $data['paciente_numeroDireccion'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="colonia">Colonia o Fraccionamiento:</label>
                            <input type="text" name="colonia" id="colonia" value="<?php echo $data['paciente_coloniaDireccion'] ?? ''; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="servicio">Servicio que solicita:</label>
                            <input type="text" name="derechoHabiente" id="derechoHabiente" value="<?php echo $data['paciente_derechoHabiente'] ?? ''; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="dx">Dx inicial:</label>
                            <textarea name="dx" id="dx" rows="3" disabled><?php echo $data['paciente_dx'] ?? ''; ?></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="observaciones">Observaciones:</label>
                            <textarea name="observaciones" id="observaciones" rows="5" disabled><?php echo $data['paciente_observaciones'] ?? ''; ?></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="hoja_frontal">Hoja frontal:</label>
                            <input type="file" name="hoja_frontal" id="hoja_frontal" disabled>
                        </div>
                        <div class="form-group">
                            <label for="hoja_compromiso">Hoja de compromiso:</label>
                            <input type="file" name="hoja_compromiso" id="hoja_compromiso" disabled>
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="button">Generar Hoja Frontal</button>
                        <button type="button">Generar Hoja de Compromiso</button>
                    </div>
                </form>
            </div>






            <div id="responsable" class="tab-content">
                <h2>Datos del Responsable</h2>
                <form action="">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre_responsable">Nombre(s):</label>
                            <input type="text" name="nombre_responsable" id="nombre_responsable" value="<?php echo $data['tutor_nombres'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="apellido_p_responsable">Apellido paterno:</label>
                            <input type="text" name="apellido_p_responsable" id="apellido_p_responsable" value="<?php echo $data['tutor_apellidoPaterno'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="apellido_m_responsable">Apellido materno:</label>
                            <input type="text" name="apellido_m_responsable" id="apellido_m_responsable" value="<?php echo $data['tutor_apellidoMaterno'] ?? ''; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="parentesco">Parentesco:</label>
                            <input type="text" name="parentesco" id="parentesco" value="<?php echo $data['tutor_parentesco'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" name="telefono" id="telefono" value="<?php echo $data['tutor_telefono'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="ocupacion">Ocupación:</label>
                            <input type="text" name="ocupacion" id="ocupacion" value="<?php echo $data['tutor_ocupacion'] ?? ''; ?>" disabled>
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
                            <input type="text" name="calle_responsable" id="calle_responsable" value="<?php echo $data['tutor_calleDireccion'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="numero_responsable">Número:</label>
                            <input type="text" name="numero_responsable" id="numero_responsable" value="<?php echo $data['tutor_numeroDireccion'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="colonia_responsable">Colonia o Fraccionamiento:</label>
                            <input type="text" name="colonia_responsable" id="colonia_responsable" value="<?php echo $data['tutor_coloniaDireccion'] ?? ''; ?>" disabled>
                        </div>
                    </div>

                    <hr>

                    <h2>Trabajo social</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="personas_hogar">No. de personas en el hogar:</label>
                            <input type="number" name="personas_hogar" id="personas_hogar" min="1" value="<?php echo $data['tutor_noPersonasHogar'] ?? ''; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="personas_apoyo">Personas que apoyan al sostenimiento del hogar:</label>
                            <input type="number" name="personas_apoyo" id="personas_apoyo" min="0" value="<?php echo $data['tutor_noPersonasApoyanEconomiaHogar'] ?? ''; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="derechohabiente">Derechohabiente a:</label>
                            <input type="text" name="derechohabiente" id="derechohabiente" value="<?php echo $data['tutor_derechoHabiente'] ?? ''; ?>" disabled>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="ingresos">Total de ingresos:</label>
                            <input type="number" name="ingresos" id="ingresos" min="0" step="0.01" value="<?php echo $data['tutor_totalIngresos'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="egresos">Total de egresos:</label>
                            <input type="number" name="egresos" id="egresos" min="0" step="0.01" value="<?php echo $data['tutor_totalIngresos'] ?? ''; ?>" disabled>
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
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#tabla_ingresos_paciente').DataTable();
    });
</script>

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