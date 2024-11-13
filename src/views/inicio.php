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
					<!-- Paso 2: Crear un elemento <canvas> donde se mostrará la gráfica -->
					<canvas id="miGrafica" width="30" height="15"></canvas>

					<!-- Incluir la biblioteca Chart.js desde un CDN -->
					<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

					<!-- Paso 3: Agregar el script para configurar y mostrar la gráfica -->
					<script src="../../JS/graficas.js">  </script>
				</div>
			</div>



			<div class="contentbox">
				<h2>Total pacientes</h2>
				<img src="../../img/pacientes.png" alt="pacientes" height="30">
				<br>
				<p>El hospital cuenta con un total de 357 pacientes registrados</p>
			</div>

			<!-- <div class="contentbox">
				<h2>Buscar paciente</h2>
				<img src="../../img/Hospital Municipal del Niño de Durango.jpeg" alt="hospital" height="50">
				<br>
				<p>Ingrese el No.de registro del paciente</p>
				<br>
				<i class="fa-solid fa-magnifying-glass"></i> <input type="text" placeholder="Buscar" name="busqueda">
				<button>Buscar</button>
			</div> -->

			<!-- <div class="subcontainer">
					<h2>Manual de</h2>
					<img src="../../img/Hospital Municipal del Niño de Durango.jpeg" alt="hospital" height="50">
					<br>
	
				<!-- <div class="contentbox">
					<h2>Formato de Hoja frontal</h2>
					<img src="../../img/Hospital Municipal del Niño de Durango.jpeg" alt="hospital" height="50">
					<br>
					<button onclick="window.open('../../pdfs/hoja frontal.pdf', '_blank')">Imprimir</button>
				</div> -->
			</div> -->

		</div>
	</section>
</body>
</html>