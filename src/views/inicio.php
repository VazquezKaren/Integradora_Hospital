<?php 
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES, MODIFICAR EN CASO DE CAMBIAR RUTAS DE LOCALIZACION DE LOS ARCHIVOS DEL PROYECTO
include('cabecera.php'); 

require_once '../config.php';
$conn = new conn();
$pdo = $conn->connect();

?>
	<section>
		<div class="content-grid">
			<div class="contentbox">
				<h2>Registar paciente</h2>
				<img src="../../img/Hospital Municipal del Niño de Durango.jpeg" alt="hospital" height="50">
				<br>
				<p>El paciente se registrara en la base de datos</p>
				<br>
				<button><a href="registro.php">Registrar</a></button>
			</div>

			<div class="contentbox">
				<h2>Buscar paciente</h2>
				<img src="../../img/Hospital Municipal del Niño de Durango.jpeg" alt="hospital" height="50">
				<br>
				<p>Ingrese el No.de registro del paciente</p>
				<br>
				<i class="fa-solid fa-magnifying-glass"></i> <input type="text" placeholder="Buscar" name="busqueda">
				<button>Buscar</button>
			</div>

			<div class="subcontainer">
				<div class="contentbox">
					<h2>Formato de Hoja de consentimiento</h2>
					<img src="../../img/Hospital Municipal del Niño de Durango.jpeg" alt="hospital" height="50">
					<br>
					<button onclick="window.open('../../pdfs/hoja consentimiento.pdf', '_blank')">Imprimir</button>
				</div>
	
				<div class="contentbox">
					<h2>Formato de Hoja frontal</h2>
					<img src="../../img/Hospital Municipal del Niño de Durango.jpeg" alt="hospital" height="50">
					<br>
					<button onclick="window.open('../../pdfs/hoja frontal.pdf', '_blank')">Imprimir</button>
				</div>
			</div>
		</div>
	</section>
</body>
</html>