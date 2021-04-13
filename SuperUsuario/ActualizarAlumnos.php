<?php include("../BaseDatos/conexion.php"); //Realizamos la conexión con la base de datos
include 'Modularidad/CabeceraInicio.php';
error_reporting(0);
?>
<title>Listas De Alumnos</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	.topnav {
		overflow: hidden;
		background-color: #ADADB2;
		max-width: 100%;
	}

	.topnav a {
		float: left;
		display: block;
		color: #f2f2f2;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
		border-width: 3px;
		font-weight: bold;


	}

	.submenu1 {
		color: #f2f2f2;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
		font-size: 18px;
		background-color: #9d120e;
		border-width: 3px;
		font-weight: bold;
		height: 68px;
		letter-spacing: 2px;



	}

	.topnav a:hover {
		background-color: #ddd;
		color: black;
	}

	.topnav a.active {
		background-color: #4CAF50;
		color: white;
	}

	.topnav .icon1 {
		display: none;
	}

	@media screen and (max-width: 600px) {
		.topnav a:not(:first-child) {
			display: none;
		}

		.topnav a.icon1 {
			display: inline-block;
		}
	}

	@media screen and (max-width: 600px) {
		.topnav.responsive {
			position: relative;
		}

		.topnav.responsive .icon {
			position: absolute;
			right: 0;
			top: 0;
		}

		.topnav.responsive a {
			float: none;
			display: block;
			text-align: left;
			font-size: 15px;
			height: 50px;
		}

		.titulomenu a {
			font-size: 15px;
		}

		.botonresponsivo {
			max-width: 150px;

			margin-bottom: 1px;
			display: block;
			text-decoration: none;
		}
	}
</style>
<?php
//Modularaidad para extraere los enlaces en HEAD
include 'Modularidad/EnlacesCabecera.php';
include 'Modularidad/MenuVertical.php';
// Realizamos la consulta del usuario
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$consulta = $pdo->prepare("SELECT * FROM alumnos WHERE ID_Alumno = :ID_Alumno");
	$consulta->bindParam(":ID_Alumno", $id);
	$consulta->execute();
} // Fin del consulta del if   
?>

<!--Comiezo de estructura de trabajo -->
<link rel="stylesheet" href="css/Competencia.css">
<div class="topnav" id="myTopnav">
		<a href="javascript:history.back();"><img src="../img/proximo.svg" class="icon"></a>
		<a class="titulomenu" style="background-color:#ADADB2; color: #2D2D2E; font-size: 25px;">Lista de alumnos</a>
		<a href="LIS-Alumnos.php" class="submenu1">Alumnos</a>
		<a href="LIS-Cuentas.php" class="submenu1">Cuentas</a>
		<a href="javascript:void(0);" class="icon1" onclick="myFunction()">
			<i class="fa fa-bars"></i>
		</a>
	</div>

	<div class="float-right"> <?php include 'Modularidad/Alerta.php' ?></div>
	<div class="float-right"> <?php include 'Modularidad/AlertaCorreo.php' ?></div>

<div class="container-fluid text-center">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
			</div>
			<div class="modal-body">
				<!--<h6 style=" overflow: hidden;">Datos Generales</h6>--><br>
				<hr>
				<!--Creación de empresas-->
				<?php if ($consulta->rowCount() >= 0) {
					$fila = $consulta->fetch() ?>
					<form class="text-center" action="Modelo/ModeloAlumno/ActualizarAlumno.php" method="POST">
						<br>
						<div class="col">
							<div class="md-form">
								<div class="md-form">
									<label for="materialRegisterFormFirstName">Carnet del Alumno</label>
									<input style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; background: rgb(172, 172, 172);" type="text" id="CarnetAlumno" name="CarnetAlumno" <?php echo 'value="' . $fila['ID_Alumno'] . '"';  ?> class="form-control">

								</div>
							</div>
							<div class="col">
								<!-- Last name -->
								<div class="md-form">
									<label for="materialRegisterFormLastName">Nombre del alumno</label>
									<input style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; background: rgb(172, 172, 172);" type="text" id="NombreAlumno" name="NombreAlumno" class="form-control" <?php echo 'value="' . $fila['Nombre'] . '"';  ?>>

								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<!-- First name   Tema , fecha , la hora y el tipo de taller -->
								<div class="md-form">
									<label for="materialRegisterFormFirstName">Carrera</label>
									<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; background: rgb(172, 172, 172);" type="text" id="NombreCarrera" name="NombreCarrera" class="form-control">
										<?php

										$ResuConulta4 = $fila['ID_Carrera'];

										$consulta4 = $pdo->prepare("SELECT * FROM carrera WHERE Id_Carrera = :Id_Carrera");
										$consulta4->bindParam(":Id_Carrera", $ResuConulta4);
										$consulta4->execute();
										if ($consulta4->rowCount() >= 0) {
											utf8_encode($fila4);
											$fila4 = $consulta4->fetch()

										?>
											<option <?php echo 'value="' . $ResuConulta4 . '"';  ?> selected> <?php echo $fila4['nombre'];
																											} ?>
											</option>
											<?php
											foreach ($pdo->query('SELECT Id_Carrera,Nombre FROM carrera') as $row) {
												echo '<option  value="' . $row['Id_Carrera'] . '">' . $row['Nombre'] . '</option>';
											}
											echo '</select>';
											?>

								</div>
							</div>
							<div class="col">
								<!-- Last name -->
								<div class="md-form">
									<label for="materialRegisterFormLastName">Class</label>
									<input style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; background: rgb(172, 172, 172);" type="text" id="NClass" name="NClass" class="form-control" <?php echo 'value="' . $fila['Class'] . '"';  ?>>

								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<!-- First name   Tema , fecha , la hora y el tipo de taller -->
								<div class="md-form">
									<label for="materialRegisterFormFirstName">Universidad</label>
									<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; text-align: center; background: rgb(172, 172, 172);" id="idempresa" name="idempresa" class="form-control">
										<?php

										$ResuConulta3 = $fila['ID_Empresa'];
										$consulta3 = $pdo->prepare("SELECT * FROM empresas WHERE ID_Empresa = :ID_Empresa ");
										$consulta3->bindParam(":ID_Empresa", $ResuConulta3);
										$consulta3->execute();
										if ($consulta3->rowCount() >= 0) {
											utf8_encode($fila3);
											$fila3 = $consulta3->fetch()

										?>
											<option <?php echo 'value="' . $ResuConulta3 . '"';  ?> selected> <?php echo $fila3['Nombre'];
																											} ?>
											</option>

											<?php
											foreach ($pdo->query("SELECT ID_Empresa,Nombre FROM empresas WHERE Tipo = 'Universidad'") as $row) {
												echo '<option value="' . $row['ID_Empresa'] . '">' . $row['Nombre'] . '</option>';
											}
											echo '</select>';
											?>

								</div>
							</div>
							<div class="col">
								<!-- Last name -->
								<div class="md-form">
									<label for="materialRegisterFormLastName">Sexo</label>
									<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; text-align: center; background: rgb(172, 172, 172);" id="Sexo" name="Sexo" class="form-control">
										<option <?php echo 'value="' . $fila['Sexo'] . '"'; ?> selected><?php echo $fila['Sexo']; ?></option>
										<option value="M">Hombre</option>
										<option value="F">Mujer</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<!-- First name   Tema , fecha , la hora y el tipo de taller -->
								<div class="md-form">
									<label for="materialRegisterFormFirstName">Correo</label>
									<input style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; background: rgb(172, 172, 172);" type="text" id="correo" name="correo" class="form-control" <?php echo 'value="' . $fila['correo'] . '"';
																																																							} ?>>
								</div>
							</div>
							<div class="col">
								<!-- Last name -->
								<div class="md-form">
									<label for="materialRegisterFormLastName">Proceso</label>
									<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; text-align: center; background: rgb(172, 172, 172);" id="IDStatus" name="IDStatus" class="form-control">
										<?php
										$ResuConulta2 = $fila['ID_Status'];
										$consulta2 = $pdo->prepare("SELECT * FROM status WHERE ID_Status = :ID_Status");
										$consulta2->bindParam(":ID_Status", $ResuConulta2);
										$consulta2->execute();
										if ($consulta2->rowCount() >= 0) {
											$fila2 = $consulta2->fetch()

										?>
											<option <?php echo 'value="' . $ResuConulta2 . '"';  ?> selected> <?php echo $fila2['Nombre'];
																											} ?>
											</option>
											<?php
											foreach ($pdo->query('SELECT ID_Status,Nombre FROM status') as $row) {
												echo '<option value="' . $row['ID_Status'] . '">' . $row['Nombre'] . '</option>';
											}
											echo '</select>';
											?>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<!-- First name   Tema , fecha , la hora y el tipo de taller -->
								<div class="md-form">
									<label for="materialRegisterFormFirstName">Sede</label>
									<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; text-align: center; background: rgb(172, 172, 172);" type="text" id="sede" name="sede" class="form-control">
										<?php

										$ResuConulta = $fila['ID_Sede'];
										$consulta1 = $pdo->prepare("SELECT * FROM sedes WHERE ID_Sede = :ID_Sede");
										$consulta1->bindParam(":ID_Sede", $ResuConulta);
										$consulta1->execute();
										if ($consulta1->rowCount() >= 0) {
											utf8_encode($fila1);
											$fila1 = $consulta1->fetch()
										?>
											<option <?php echo 'value="' . $ResuConulta . '"';  ?> selected> <?php echo $fila1['Nombre'];
																											} ?>
											</option>

											<?php
											foreach ($pdo->query('SELECT ID_Sede,Nombre FROM sedes') as $row) {

												echo '<option value="' . $row['ID_Sede'] . '">' . $row['Nombre'] . '</option>';
											}

											echo '</select>';
											?>
								</div>
							</div>
							<div class="col">
								<!-- First name   Tema , fecha , la hora y el tipo de taller -->
								<div class="md-form">
									<label for="materialRegisterFormFirstName">Lugar Asistencia</label>
									<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px;background: rgb(172, 172, 172);" type="text" id="Asistencia" name="Asistencia" class="form-control">
										<?php
										$ResuConulta5 = $fila['SedeAsistencia'];
										$consulta5 = $pdo->prepare("SELECT * FROM sedes WHERE ID_Sede = :ID_Sede");
										$consulta5->bindParam(":ID_Sede", $ResuConulta5);
										$consulta5->execute();
										if ($consulta5->rowCount() >= 0) {
											$fila5 = $consulta5->fetch()

										?>
											<option <?php echo 'value="' . $ResuConulta5 . '"';  ?> selected> <?php echo $fila5['Nombre'];
																											} ?>
											</option>

											?>

											<option value="SSFT">San Salvador</option>
											<option value="SAFT">Santa Ana</option>
									</select>

								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<!-- Last name -->
								<div class="md-form">
									<label for="materialRegisterFormFirstName">Status actual (A LA FECHA)</label>
									<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; text-align: center; background: rgb(172, 172, 172);" type="text" id="estadoAlumno" name="statusActual" class="form-control" required>
										<option value="<?php echo $fila['StatusActual'] ?>" selected><?php echo $fila['StatusActual'] ?></option>
										<option value="Becado">Becado</option>
										<option value="Declinado">Declinado</option>
										<option value="Declinado-apoyo extraordinario">Declinado-apoyo extraordinario</option>
										<option value="Beca Denegada">Beca Denegada</option>
										<option value="Crédito Educativo">Crédito Educativo</option>
										<option value="Cambio Tipo Carrera Graduado">Cambio Tipo Carrera Graduado</option>
										<option value="Cambio Tipo Carrera No Graduado">Cambio Tipo Carrera No Graduado</option>
										<option value="Beca a la Perseverancia">Beca a la Perseverancia</option>
										<option value="Beca Cancelada">Beca Cancelada</option>
										<option value="Egresado">Egresado</option>
										<option value="Graduado">Graduado</option>
										<option value="Pausa">Pausa</option>
										<option value="Fallecido">Fallecido</option>
									</select>

								</div>
							</div>
							<div class="col">
								<div class="md-form">
									<label for="materialRegisterFormFirstName">Fuente de financiamiento</label>
									<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; text-align: center; background: rgb(172, 172, 172);" type="text" id="financiamiento" name="financiamiento" class="form-control" required>
										<option value="<?php echo $fila['FuenteFinacimiento'] ?>" selected><?php echo $fila['FuenteFinacimiento'] ?></option>
										<option value="Beca Externa con Apoyo Adicional">Beca Externa con Apoyo Adicional</option>
										<option value="Borja">Borja</option>
										<option value="FGK">FGK</option>
										<option value="FOM">FOM</option>
										<option value="Financiamiento Propio">Financiamiento Propio</option>
									</select>

								</div>
							</div>
						</div>


						<h6 style="color: rgb(55, 55, 55); text-align: center;" class="float-left">Historico del alumno de los talleres</h6><br>
						<hr>
						<div class="form-row">
							<div class="col">
								<div class="md-form">
									<label for="materialRegisterFormFirstName">Estado</label>
									<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px;background: rgb(172, 172, 172);" type="text" id="estadoAlumno" name="estadoAlumno" class="form-control">
										<option <?php echo 'value="' . $fila['Estado'] . '"';  ?> selected><?php echo $fila['Estado'];  ?></option>
										<option value="Activo">Activo</option>
										<option value="Graduado">Graduado</option>
										<option value="Inactivo">Inactivo</option>
									</select>

								</div>
							</div>

							<div class="col">
								<div class="md-form">
									<label for="materialRegisterFormFirstName">Cantidad de talleres</label>
									<input style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; background: rgb(172, 172, 172);" type="number" name="cantidaTaller" class="form-control" placeholder="Ingrese la cantida de talleres" min="0" required value="<?php echo $fila['TotalTalleres'] ?>">

								</div>
							</div>
						</div>
						<input style="color: white; font-size: 18px; border: solid 1px; border-radius: 30px;" type="hidden" name="id" <?php echo 'value="' . $fila['ID_Alumno'] . '"';  ?>>
						<center><button style="border-radius: 20px; border: 2px solid #9d120e; width: 200px;height: 38px; background-color: #9d120e; color:white;" name="Guardar_Datos" value="Actualizar Alumno">Actualizar Alumno</button></center>
					</form>
					<a href="LIS-Alumnos.php" style="color: white ">
						<img src="img/left-arrow.png" width="40px" height="40px">
					</a>
			</div>
		</div>
	</div>
	<script>
		function myFunction() {
			var x = document.getElementById("myTopnav");
			if (x.className === "topnav") {
				x.className += " responsive";
			} else {
				x.className = "topnav";
			}
		}
	</script>
	
	<!--/.Navbar-->
	<br><br><br><br>
	<br><br>

	<script type="text/javascript">
		$("#todos").on("click", function() {
			$(".case").prop("checked", this.checked);
		});

		// if all checkbox are selected, check the selectall checkbox and viceversa  
		$(".case").on("click", function() {
			if ($(".case").length == $(".case:checked").length) {
				$("#todos").prop("checked", true);
			} else {
				$("#todos").prop("checked", false);
			}
		});
	</script>

	<?php
	//Incluir el footer
	include 'Modularidad/PiePagina.php';
	?>