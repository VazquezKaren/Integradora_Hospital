<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="JS/main.js"></script>
    <script src="JS/alertas.js"></script>
</head>

<body>
    <div class="loader-container">
        <div class="loader"></div>
    </div>
    <div class="container">
        <div class="left-panel">
            <img src="img/Hospital Municipal del Niño de Durango.jpeg" alt="Imagen del hospital">
        </div>
        <div class="right-panel">
            <h2>Hospital del Niño</h2>
            <p>Durango, Dgo.</p>
            <form action="src/controladores/controlador_index.php" method="POST">

                <?php
                include('src/config.php');

                if (isset($_GET['error'])) {
                    echo "<p class='error-message'>" . htmlspecialchars($_GET['error']) . "</p>";
                    /*
                        echo "<script>noacceso();</script>";
                        */
                }
                ?>

                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required placeholder="Ingrese su usuario">

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required placeholder="Ingrese su contraseña">

                <input type="submit" name="btningresar" value="Ingresar" class="btninput">
            </form>
        </div>
    </div>
</body>

</html>