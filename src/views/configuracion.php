<?php
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES, MODIFICAR EN CASO DE CAMBIAR RUTAS DE LOCALIZACION DE LOS ARCHIVOS DEL PROYECTO
include('cabecera.php');
?>

<section>
    <div class="content-grid">
        <!-- Configuración del logo -->
        <div class="contentbox">
            <h2>Configuración del sistema</h2>
            <h3>Administrar Logo</h3>
            <form action="../controladores/guardarLogo.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="logo">Seleccionar nuevo logo:</label>
                    <input type="file" name="logo" id="logo" accept="image/*">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar Logo</button>
                </div>
            </form>

            
            <form action="../controladores/eliminarLogo.php" method="POST">
                <div class="form-group">
                    <button type="submit" class="btn btn-danger">Eliminar Logo</button>
                </div>
            </form>
            <div>
                <h4>Vista previa del logo actual:</h4>
                <img src="../uploads/logo.png" alt="Logo actual" style="max-width: 200px; max-height: 100px;">
            </div>
        </div>
    </div>
</section>
</html>