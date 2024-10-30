<?php
include '../../config.php';

// Preparar y sanitizar los datos del paciente
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$apellido_paterno = filter_input(INPUT_POST, 'apellido_paterno', FILTER_SANITIZE_STRING);
$apellido_materno = filter_input(INPUT_POST, 'apellido_materno', FILTER_SANITIZE_STRING);
$fecha_nacimiento = filter_input(INPUT_POST, 'fecha_nacimiento', FILTER_SANITIZE_STRING);
$edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT);
if ($edad === false) {
    throw new Exception("Edad no válida");
}
$lugar_nacimiento = filter_input(INPUT_POST, 'lugar_nacimiento', FILTER_SANITIZE_STRING);
$sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
$servicio_solicitado = filter_input(INPUT_POST, 'servicio_solicitado', FILTER_SANITIZE_STRING);
$dx_registro = filter_input(INPUT_POST, 'dx_registro', FILTER_SANITIZE_STRING);

// Dirección del paciente
$direccion_calle = htmlspecialchars($_POST['direccion_calle']);
$direccion_numero = htmlspecialchars($_POST['direccion_numero']);
$direccion_colonia = htmlspecialchars($_POST['direccion_colonia']);

// Información del tutor
$tutor_nombre = htmlspecialchars($_POST['tutor_nombre']);
$tutor_apellido_paterno = htmlspecialchars($_POST['tutor_apellido_paterno']);
$tutor_apellido_materno = htmlspecialchars($_POST['tutor_apellido_materno']);
$parentesco = htmlspecialchars($_POST['parentesco']);
$telefono = htmlspecialchars($_POST['telefono']);
$ocupacion = htmlspecialchars($_POST['ocupacion']);
$tutor_direccion_calle = htmlspecialchars($_POST['tutor_direccion_calle']);
$tutor_direccion_numero = htmlspecialchars($_POST['tutor_direccion_numero']);
$tutor_direccion_colonia = htmlspecialchars($_POST['tutor_direccion_colonia']);

// Trabajo social
$personas_hogar = (int)$_POST['personas_hogar'];
$clasificacion_trabajo_social = htmlspecialchars($_POST['clasificacion_trabajo_social']);
$personas_apoyo = htmlspecialchars($_POST['personas_apoyo']);
$indice_economico = htmlspecialchars($_POST['indice_economico']);
$derechohabiente = htmlspecialchars($_POST['derechohabiente']);
$derechohabiente_otro = htmlspecialchars($_POST['derechohabiente_otro']);
$observaciones = htmlspecialchars($_POST['observaciones']);

try {
    // Iniciar una transacción
    $conn->beginTransaction();

    // Comprobar si el paciente ya está registrado usando idPaciente
    $sql_check = "SELECT idPaciente FROM paciente WHERE idPaciente = :idPaciente";
    $stmt = $conn->prepare($sql_check);
    $stmt->execute([
        ':idPaciente' => $_POST['idPaciente']
    ]);
    $idPaciente = $stmt->fetchColumn();

    if ($idPaciente) {
        // Actualizar los datos del paciente
        $sql_update = "UPDATE paciente SET 
            edad = :edad, 
            lugar_nacimiento = :lugar_nacimiento, 
            sexo = :sexo, 
            servicio_solicitado = :servicio_solicitado, 
            dx_registro = :dx_registro, 
            direccion_calle = :direccion_calle, 
            direccion_numero = :direccion_numero, 
            direccion_colonia = :direccion_colonia, 
            tutor_nombre = :tutor_nombre, 
            tutor_apellido_paterno = :tutor_apellido_paterno, 
            tutor_apellido_materno = :tutor_apellido_materno, 
            parentesco = :parentesco, 
            telefono = :telefono, 
            ocupacion = :ocupacion, 
            tutor_direccion_calle = :tutor_direccion_calle, 
            tutor_direccion_numero = :tutor_direccion_numero, 
            tutor_direccion_colonia = :tutor_direccion_colonia, 
            personas_hogar = :personas_hogar, 
            clasificacion_trabajo_social = :clasificacion_trabajo_social, 
            personas_apoyo = :personas_apoyo, 
            indice_economico = :indice_economico, 
            derechohabiente = :derechohabiente, 
            derechohabiente_otro = :derechohabiente_otro, 
            observaciones = :observaciones 
            WHERE idPaciente = :idPaciente";
        
        $stmt = $conn->prepare($sql_update);
        $stmt->execute([
            ':edad' => $edad,
            ':lugar_nacimiento' => $lugar_nacimiento,
            ':sexo' => $sexo,
            ':servicio_solicitado' => $servicio_solicitado,
            ':dx_registro' => $dx_registro,
            ':direccion_calle' => $direccion_calle,
            ':direccion_numero' => $direccion_numero,
            ':direccion_colonia' => $direccion_colonia,
            ':tutor_nombre' => $tutor_nombre,
            ':tutor_apellido_paterno' => $tutor_apellido_paterno,
            ':tutor_apellido_materno' => $tutor_apellido_materno,
            ':parentesco' => $parentesco,
            ':telefono' => $telefono,
            ':ocupacion' => $ocupacion,
            ':tutor_direccion_calle' => $tutor_direccion_calle,
            ':tutor_direccion_numero' => $tutor_direccion_numero,
            ':tutor_direccion_colonia' => $tutor_direccion_colonia,
            ':personas_hogar' => $personas_hogar,
            ':clasificacion_trabajo_social' => $clasificacion_trabajo_social,
            ':personas_apoyo' => $personas_apoyo,
            ':indice_economico' => $indice_economico,
            ':derechohabiente' => $derechohabiente,
            ':derechohabiente_otro' => $derechohabiente_otro,
            ':observaciones' => $observaciones,
            ':idPaciente' => $idPaciente
        ]);

        // Limpiar los campos del formulario--- PENDIENTE
        $_POST = array();


        // Confirmar la transacción
        $conn->commit();
        echo "Datos del paciente actualizados correctamente.";
    } else {
        echo "Paciente no encontrado.";
    }
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conn->rollBack();
    echo "Error al actualizar los datos del paciente: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Paciente</title>
</head>
<body>
    <form id="modificarPacienteForm" method="POST" action="/C:/xampp/htdocs/Integradora_Hospital/src/controladores/modificar_paciente">
        <!-- Campos del formulario -->
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
        
        <label for="apellido_paterno">Apellido Paterno</label>
        <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno" required>
        
        <label for="apellido_materno">Apellido Materno</label>
        <input type="text" id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno" required>
        
        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" required>
        
        <label for="edad">Edad</label>
        <input type="number" id="edad" name="edad" placeholder="Edad" required>
        
        <label for="lugar_nacimiento">Lugar de Nacimiento</label>
        <input type="text" id="lugar_nacimiento" name="lugar_nacimiento" placeholder="Lugar de Nacimiento" required>
        
        <label for="sexo">Sexo</label>
        <input type="text" id="sexo" name="sexo" placeholder="Sexo" required>
        
        <label for="servicio_solicitado">Servicio Solicitado</label>
        <input type="text" id="servicio_solicitado" name="servicio_solicitado" placeholder="Servicio Solicitado" required>
        
        <label for="dx_registro">Dx Registro</label>
        <input type="text" id="dx_registro" name="dx_registro" placeholder="Dx Registro" required>
        
        <label for="direccion_calle">Calle</label>
        <input type="text" id="direccion_calle" name="direccion_calle" placeholder="Calle" required>
        
        <label for="direccion_numero">Número</label>
        <input type="text" id="direccion_numero" name="direccion_numero" placeholder="Número" required>
        
        <label for="direccion_colonia">Colonia</label>
        <input type="text" id="direccion_colonia" name="direccion_colonia" placeholder="Colonia" required>
        
        <label for="tutor_nombre">Nombre del Tutor</label>
        <input type="text" id="tutor_nombre" name="tutor_nombre" placeholder="Nombre del Tutor" required>
        
        <label for="tutor_apellido_paterno">Apellido Paterno del Tutor</label>
        <input type="text" id="tutor_apellido_paterno" name="tutor_apellido_paterno" placeholder="Apellido Paterno del Tutor" required>
        
        <label for="tutor_apellido_materno">Apellido Materno del Tutor</label>
        <input type="text" id="tutor_apellido_materno" name="tutor_apellido_materno" placeholder="Apellido Materno del Tutor" required>
        
        <label for="parentesco">Parentesco</label>
        <input type="text" id="parentesco" name="parentesco" placeholder="Parentesco" required>
        
        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="telefono" placeholder="Teléfono" required>
        
        <label for="ocupacion">Ocupación</label>
        <input type="text" id="ocupacion" name="ocupacion" placeholder="Ocupación" required>
        
        <label for="tutor_direccion_calle">Calle del Tutor</label>
        <input type="text" id="tutor_direccion_calle" name="tutor_direccion_calle" placeholder="Calle del Tutor" required>
        
        <label for="tutor_direccion_numero">Número del Tutor</label>
        <input type="text" id="tutor_direccion_numero" name="tutor_direccion_numero" placeholder="Número del Tutor" required>
        
        <label for="tutor_direccion_colonia">Colonia del Tutor</label>
        <input type="text" id="tutor_direccion_colonia" name="tutor_direccion_colonia" placeholder="Colonia del Tutor" required>
        
        <label for="personas_hogar">Personas en el Hogar</label>
        <input type="number" id="personas_hogar" name="personas_hogar" placeholder="Personas en el Hogar" required>
        
        <label for="clasificacion_trabajo_social">Clasificación Trabajo Social</label>
        <input type="text" id="clasificacion_trabajo_social" name="clasificacion_trabajo_social" placeholder="Clasificación Trabajo Social" required>
        
        <label for="personas_apoyo">Personas de Apoyo</label>
        <input type="text" id="personas_apoyo" name="personas_apoyo" placeholder="Personas de Apoyo" required>
        
        <label for="indice_economico">Índice Económico</label>
        <input type="text" id="indice_economico" name="indice_economico" placeholder="Índice Económico" required>
        
        <label for="derechohabiente">Derechohabiente</label>
        <input type="text" id="derechohabiente" name="derechohabiente" placeholder="Derechohabiente" required>
        
        <label for="derechohabiente_otro">Otro Derechohabiente</label>
        <input type="text" id="derechohabiente_otro" name="derechohabiente_otro" placeholder="Otro Derechohabiente" required>
        
        <label for="observaciones">Observaciones</label>
        <textarea id="observaciones" name="observaciones" placeholder="Observaciones" required></textarea>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>