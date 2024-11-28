<?php
$logoPath = '../uploads/logo.png';
if (file_exists($logoPath)) {
    unlink($logoPath);
    echo "<script>alert('Logo eliminado con éxito'); window.location.href = '../views/configuracion.php';</script>";
} else {
    echo "<script>alert('No hay un logo para eliminar'); window.location.href = '../views/configuracion.php';</script>";
}
?>