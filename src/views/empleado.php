<?php 
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES, MODIFICAR EN CASO DE CAMBIAR RUTAS DE LOCALIZACION DE LOS ARCHIVOS DEL PROYECTO
include('cabecera.php'); 
session_start();
?>

    <section>
        <div class="content-grid">
            <div class="contentbox">
                <h2>Perfil de Usuario</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Campo</th>
                            <th>Dato</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nombre:</td>
                            <td><?php echo $_SESSION['nombreEmpleado']; ?></td>
                        </tr>
                        <tr>
                            <td>Apellidos:</td>
                            <td> <?php echo $_SESSION['apellidoPaternoEmpleado'] . $_SESSION['apellidoMaternoEmpleado'];?></td>
                        </tr>
                        <tr>
                            <td>Correo Electrónico:</td>
                            <td>ricardo.perez@example.com</td>
                        </tr>
                        <tr>
                            <td>Teléfono:</td>
                            <td>(555) 123-4567</td>
                        </tr>
                        <tr>
                            <td>Rol:</td>
                            <td>Enfermero</td>
                        </tr>
                    </tbody>
                </table>
                <button style="background-color: #ff4d4d; color: white;">Cerrar sesion</button>
            </div>
        </div>
    </section>
</body>

</html>
