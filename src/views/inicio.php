<?php 
// BARRA DE NAVEACION Y MENU DE INTERACCION ENTRE SECCIONES, MODIFICAR EN CASO DE CAMBIAR RUTAS DE LOCALIZACION DE LOS ARCHIVOS DEL PROYECTO
include('cabecera.php'); 
include('../controladores/pacientes_ingresados.php');
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
				<h2>Pacientes dentro del Hospital</h2>
				<img src="../../img/pacientes.png" alt="pacientes" height="30">
				<br>
				<p>El hospital cuenta con un total de <?php echo $ingresos; ?> pacientes ingresados</p>
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
				<?php if (in_array($privilegio, ['ADMIN', 'DOCTOR', 'TRABAJO_SOCIAL','ENFERMERA'])) { ?>
					<div class="manual-section">
						<img src="../../img/manual/img-1.png" alt="Paso 1">
						<p> Inicio de sesión para el programa | Ingresar credenciales correctas.</p>
					</div>
				<?php } ?>
				<?php if ($privilegio == 'ADMIN') { ?>
					<div class="manual-section">
						<img src="../../img/manual/ingresar empleado.png" alt="Paso 2">
						<p>Para registrar a un empleado deberá ir al apartado de "Empleados" y dar click en "Registrar empleado" para llenar los campos necesarios.</p>
					</div>
				<?php } ?>
				<?php if (in_array($privilegio, ['ADMIN'])) { ?>
					<div class="manual-section">
						<img src="../../img/manual/consultarempl.png" alt="Paso 3">
						<p>Para consultar a un empleado, deberá ir al apartado de "Empleados" y dar click en "Consultar empleado" para buscarlo con el número telefónico correspondiente.</p>
					</div>
				<?php } ?>
				<?php if (in_array($privilegio, ['ADMIN', 'DOCTOR','TRABAJO_SOCIAL'])) { ?>
					<div class="manual-section">
						<img src="../../img/manual/registrarpaciente.png" alt="Paso 4">
						<p>Para registrar a un paciente deberá ir al apartado de "Pacientes" y dar click en "Registrar paciente" para llenar los campos necesarios.</p>
					</div>
				<?php } ?>
				<?php if (in_array($privilegio, ['ADMIN', 'DOCTOR','TRABAJO_SOCIAL','ENFERMERA'])) { ?>
					<div class="manual-section">
						<img src="../../img/manual/consultarpaciente.png" alt="Paso 5">
						<p>Para consultar a un paciente, deberá ir al apartado de "Pacientes" y dar click en "Consultar paciente" para buscarlo con el No. de registro del paciente correspondiente.</p>
					</div>
				<?php } ?>
				<?php if (in_array($privilegio, ['ADMIN', 'DOCTOR','TRABAJO_SOCIAL','ENFERMERA'])) { ?>
					<div class="manual-section">
						<img src="../../img/manual/ingresos.png" alt="Paso 5">
						<p>Para consultar los Ingresos de los pacientes, deberá de ir al apartado de "Pacientes" y dar click en "Ingresos" para buscar los ingresos que necesite..</p>
					</div>
				<?php } ?>
				<?php if (in_array($privilegio, ['ADMIN', 'DOCTOR','TRABAJO_SOCIAL','ENFERMERA'])) { ?>
					<div class="manual-section">
						<img src="../../img/manual/perfilusuario.png" alt="Paso 5">
						<p>Para consultar la información de su Usuario o cambiar su contraseña, deberá de ir a la sección de su nombre y dar click para realizar las acciones anteriormente mencionadas.</p>
					</div>
				<?php } ?>
				<?php if ($privilegio == 'ADMIN') { ?>
					<div class="manual-section">
						<img src="../../img/manual/cambiarlogo.png" alt="Paso 5">
						<p>Para cambiar el logotipo de la pagina, deberá de ir al apartado de "Configuración" y seleccionar la imagen del nuevo logo y dar click en "Guardar cambios".</p>
					</div>
				<?php } ?>
				<?php if (in_array($privilegio, ['ADMIN', 'TRABAJO_SOCIAL','ENFERMERA','DOCTOR'])) { ?>
					<div class="manual-section">
						<img src="../../img/manual/historial.png" alt="Paso 5">
						<p>Para consultar el historial de las actividades realizadas, deberá ir al apartado de "Historial"en la parte de arriba.</p>
					</div>
				<?php } ?>
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

