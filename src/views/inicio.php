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
				<div class="graficas">
					INGRESOS DE LA SEMANA
					<canvas id="miGrafica" width="30" height="15"></canvas>
					<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
					<script src="../../JS/graficas.js">  </script>
				</div>
			</div>

			<div class="contentbox">
				<h2>Total pacientes</h2>
				<img src="../../img/pacientes.png" alt="pacientes" height="30">
				<br>
				<p>El hospital cuenta con un total de 357 pacientes registrados</p>
			</div>

			<div class="contentbox full-width">
				<h2>Atajos</h2>
				<p>Accede rápidamente a las aplicaciones más usadas.</p>
				<div class="shortcuts">
					<button onclick="location.href='registro.php'" class="shortcut-button">Registrar Paciente</button>
					<button onclick="location.href='ingresos.php'" class="shortcut-button">Buscar Ingresos</button>
					<button onclick="location.href='pacientes.php'" class="shortcut-button">Buscar Paciente</button>
				</div>
			</div>

			<div class="contentbox full-width">
				<h2>Manual de Usuario</h2>
				<p>Una guía rápida de cómo usar el sistema.</p>
				<button id="toggle-button">Ocultar sección</button>
				<div class="manual-usuario" id="manual-content">
					<div class="manual-section">
						<img src="../../img/manual/img-1.png" alt="Paso 1">
						<p>Paso 1: Explicación detallada del primer paso en el uso del sistema.</p>
					</div>
					<div class="manual-section">
						<img src="../../img/manual/img-1.png" alt="Paso 2">
						<p>Paso 2: Explicación detallada del segundo paso en el uso del sistema.</p>
					</div>
					<div class="manual-section">
						<img src="../../img/manual/img-1.png" alt="Paso 3">
						<p>Paso 3: Explicación detallada del tercer paso en el uso del sistema.</p>
					</div>
					<div class="manual-section">
						<img src="../../img/manual/img-1.png" alt="Paso 4">
						<p>Paso 4: Explicación detallada del cuarto paso en el uso del sistema.</p>
					</div>
					<div class="manual-section">
						<img src="../../img/manual/img-1.png" alt="Paso 5">
						<p>Paso 5: Explicación detallada del quinto paso en el uso del sistema.</p>
					</div>
				</div>
			</div>
			<script src="../../JS/manual.js"></script>
			<!-- <br> -->
			<!-- <div class="subcontainer">
				<div class="contentbox">
					<h2>Buscar paciente</h2>
					<img src="../../img/Hospital Municipal del Niño de Durango.jpeg" alt="hospital" height="50">
					<br>
					<p>Ingrese el No.de registro del paciente</p>
					<br>
					<i class="fa-solid fa-magnifying-glass"></i> <input type="text" placeholder="Buscar" name="busqueda">
					<button>Buscar</button>
				</div>
				<div class="contentbox">
					<h2>Formato de Hoja frontal</h2>
					<img src="../../img/Hospital Municipal del Niño de Durango.jpeg" alt="hospital" height="50">
					<br>
					<button onclick="window.open('../../pdfs/hoja frontal.pdf', '_blank')">Imprimir</button>
				</div>
			</div> -->

		</div>
	</section>
</body>
</html>