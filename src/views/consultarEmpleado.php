<?php
include ("cabecera.php");
if (!isset($_SESSION['usuario'])) {
	header("location: ../../index.php");
}

if ($_SESSION['rol'] !== 'ADMIN') {
	echo('Acceso denegado, solo personal autorizado');
    exit;
}
?>
    
    <section class="main-content">
        <div class="content-grid">
            <div class="contentbox employee-info">
                <h2>Datos del Empleado</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre(s):</label>
                        <input type="text" id="nombre" value="Juan" disabled>
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" id="apellidos" value="Gonzalez" disabled>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" value="1234567890" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" value="juan.gonzalez@example.com" disabled>
                    </div>
                    <div class="form-group">
                        <label for="especialidad">Especialidad:</label>
                        <input type="text" id="especialidad" value="Cardiología" disabled>
                    </div>
                </div>

                <hr>
                <h3>Dirección</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="direccion_calle">Calle:</label>
                        <input type="text" id="direccion_calle" value="Calle Principal" disabled>
                    </div>
                    <div class="form-group">
                        <label for="direccion_numero">Número:</label>
                        <input type="text" id="direccion_numero" value="123" disabled>
                    </div>
                    <div class="form-group">
                        <label for="direccion_colonia">Colonia o Fraccionamiento:</label>
                        <input type="text" id="direccion_colonia" value="Colonia Centro" disabled>
                    </div>
                </div>

                <hr>
                <div class="form-row">
                    <h3>Departamento y Rol</h3>
                    <div class="form-group">
                        <label for="departamento">Departamento:</label>
                        <input type="text" id="departamento" value="Doctor" disabled>
                    </div>
                    <div class="form-group">
                        <label for="rol">Rol:</label>
                        <input type="text" id="rol" value="Cardiólogo" disabled>
                    </div>
                </div>

                <div class="button-group">
                    <button type="button" id="edit-button" onclick="enableEditing()">Actualizar Información</button>
                    <button type="button" class="delete-button">Eliminar Información</button>
                    <button type="button" class="save-button" id="save-button" onclick="saveInformation()">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </section>

    <script>
        function enableEditing() {
            // Habilitar todos los campos de entrada
            document.querySelectorAll('input').forEach(function(input) {
                input.disabled = false;
            });

            // Mostrar botón de Guardar y ocultar botón de Actualizar
            document.getElementById('edit-button').style.display = 'none';
            document.getElementById('save-button').style.display = 'inline-block';
        }

        function saveInformation() {
            // Aquí se puede agregar la lógica para guardar los datos (como una solicitud al servidor)

            // Deshabilitar de nuevo los campos de entrada
            document.querySelectorAll('input').forEach(function(input) {
                input.disabled = true;
            });

            // Mostrar botón de Actualizar y ocultar botón de Guardar
            document.getElementById('edit-button').style.display = 'inline-block';
            document.getElementById('save-button').style.display = 'none';
        }
    </script>
</body>
</html>
