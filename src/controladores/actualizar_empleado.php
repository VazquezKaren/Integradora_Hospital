<?php
include '../config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Inicializar un arreglo para almacenar errores de validación
    $errores = [];
    // Obtener y validar datos del formulario
    $idEmpleado = $_POST['idEmpleado'] ?? null;
    $nombres = $_POST['nombres'] ?? '';
    $apellidoPaterno = $_POST['apellidoPaterno'] ?? '';
    $apellidoMaterno = $_POST['apellidoMaterno'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $especialidad = $_POST['especialidad'] ?? null;
    $rol = $_POST['rol'] ?? '';
    $calleDireccion = $_POST['calleDireccion'] ?? '';
    $numeroDireccion = $_POST['numeroDireccion'] ?? '';
    $coloniaDireccion = $_POST['coloniaDireccion'] ?? '';
    // Validaciones básicas
    if (empty($idEmpleado) || !is_numeric($idEmpleado)) {
        $errores[] = 'ID de empleado inválido.';
    }
    if (empty($nombres)) {
        $errores[] = 'El campo nombres es obligatorio.';
    }
    if (empty($apellidoPaterno)) {
        $errores[] = 'El campo apellido paterno es obligatorio.';
    }
    if (empty($telefono)) {
        $errores[] = 'El campo teléfono es obligatorio.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El email proporcionado no es válido.';
    }
    if (empty($rol)) {
        $errores[] = 'El campo rol es obligatorio.';
    }
    // Si hay errores de validación, devolverlos al cliente
    if (count($errores) > 0) {
        echo json_encode(['success' => false, 'message' => 'Errores de validación.', 'errors' => $errores]);
        exit;
    }
    try {
        $conn = new conn();
        $pdo = $conn->connect();
        // Iniciar una transacción
        $pdo->beginTransaction();
        // Preparar y ejecutar la actualización en la tabla empleado
        $sqlEmpleado = "UPDATE empleado SET 
            nombres = :nombres, 
            apellidoPaterno = :apellidoPaterno, 
            apellidoMaterno = :apellidoMaterno, 
            telefono = :telefono, 
            email = :email, 
            especialidad = :especialidad, 
            calleDireccion = :calleDireccion, 
            numeroDireccion = :numeroDireccion, 
            coloniaDireccion = :coloniaDireccion
            WHERE idEmpleado = :idEmpleado";
        $stmtEmpleado = $pdo->prepare($sqlEmpleado);
        $stmtEmpleado->execute([
            'nombres' => htmlspecialchars(trim($nombres)),
            'apellidoPaterno' => htmlspecialchars(trim($apellidoPaterno)),
            'apellidoMaterno' => htmlspecialchars(trim($apellidoMaterno)),
            'telefono' => htmlspecialchars(trim($telefono)),
            'email' => htmlspecialchars(trim($email)),
            'especialidad' => htmlspecialchars(trim($especialidad)),
            'calleDireccion' => htmlspecialchars(trim($calleDireccion)),
            'numeroDireccion' => htmlspecialchars(trim($numeroDireccion)),
            'coloniaDireccion' => htmlspecialchars(trim($coloniaDireccion)),
            'idEmpleado' => (int)$idEmpleado
        ]);
        // Verificar si se actualizó algún registro
        if ($stmtEmpleado->rowCount() === 0) {
            throw new Exception('No se pudo actualizar la información del empleado. Verifique que el ID sea correcto.');
        }
        // Preparar y ejecutar la actualización en la tabla usuarios
        $sqlUsuario = "UPDATE usuarios SET rol = :rol WHERE fkIdEmpleado = :idEmpleado";
        $stmtUsuario = $pdo->prepare($sqlUsuario);
        $stmtUsuario->execute([
            'rol' => htmlspecialchars(trim($rol)),
            'idEmpleado' => (int)$idEmpleado
        ]);
        // Confirmar la transacción
        $pdo->commit();
        echo json_encode(['success' => true, 'message' => 'Empleado actualizado correctamente.']);
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        // Registrar el error en un archivo de log (opcional)
        error_log($e->getMessage());
        // Devolver un mensaje genérico al cliente
        echo json_encode(['success' => false, 'message' => 'Ocurrió un error al actualizar el empleado. Por favor, inténtelo de nuevo más tarde.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>