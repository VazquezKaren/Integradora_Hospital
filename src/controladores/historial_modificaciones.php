<?php
/**
 * Guarda una modificación en el historial de modificaciones.
 *
 * @param string $usuario El nombre del usuario que realizó la modificación.
 * @param string $descripcion La descripción de la modificación.
 */
function guardarModificacion($usuario, $descripcion) {
    global $conn;
    $sql = "INSERT INTO historial_modificaciones (usuario, fecha, descripcion) VALUES (?, NOW(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $descripcion);
    $stmt->execute();
    $stmt->close();
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el usuario del empleado
session_start();
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

// Consultar el historial de modificaciones
$sql = "SELECT * FROM historial_modificaciones WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Descripción</th>
        </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["usuario"] . "</td>
            <td>" . $row["fecha"] . "</td>
            <td>" . $row["descripcion"] . "</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron modificaciones.";
}

$stmt->close();
$conn->close();

// Ejemplo de uso del disparador
// Asegúrate de que el usuario esté autenticado antes de guardar una modificación
if ($usuario) {
    $descripcion = "Descripción de la modificación realizada";
    guardarModificacion($usuario, $descripcion);
} else {
    echo "Usuario no autenticado. No se puede guardar la modificación.";
}
?>