<?php require_once "../../../BaseDatos/conexion.php"; 

session_start();  
$varsesion = $_SESSION['Email'];
$varLugar = $_SESSION['Lugar'];
error_reporting(0);
if ($varsesion == null || $varsesion = "") {
	header("Location: ../login.php");
	die();
}


?>
<?php
// Realizamos la consulta del usuario
if (isset($_GET['id'])) {
	$id=$_GET['id'];

	$consulta=$pdo->prepare("SELECT * FROM alumnos WHERE ID_Alumno = :ID_Alumno");
	$consulta->bindParam(":ID_Alumno",$id);
	$consulta->execute();
}// Fin del consulta del if   
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Actualizar Usuario | FGK</title>
	<link rel="shortcut icon" href="../img/WorkeysIcon.png" />
	<link rel="stylesheet" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../../css/EstiloCrearCuentas.css">
	<!--<link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
	<!--Estilo css CrearCuentas-->
</head>

<body class="container">
	<br>
	<div class="modal fade show" id="exampleModal" >
		<div class="modal-dialog" >
			<div class="modal-content" >
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel" >Actualizar Usuario</h5>
				</div>
				<div class="modal-body">
				<!--<h6 style=" overflow: hidden;">Datos Generales</h6>--><br>
				<hr>

					<!--Creación de empresas-->
					<?php if ($consulta->rowCount() >=0) {$fila=$consulta->fetch()?>
				<form class="text-center"  action="../../Modelo/ModeloAlumno/ActualizarAlumno.php" method="POST" >
					<br>
						<div class="col">
							<div class="md-form">
								<div class="md-form">
								<label for="materialRegisterFormFirstName">Carnet del Alumno</label>
								<input style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; background: rgb(172, 172, 172);" type="text" id="CarnetAlumno" name="CarnetAlumno" <?php echo 'value="'.$fila['ID_Alumno'] .'"';  ?> class="form-control">
								
							</div>
						</div>
						<div class="col">
							<!-- Last name -->
							<div class="md-form">
								<label for="materialRegisterFormLastName">Nombre del alumno</label>
								<input style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; background: rgb(172, 172, 172);" type="text" id="NombreAlumno" name="NombreAlumno" class="form-control" <?php echo 'value="'.$fila['Nombre'] .'"';  ?>>
								
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col">
							<!-- First name   Tema , fecha , la hora y el tipo de taller -->
							<div class="md-form">
								<label for="materialRegisterFormFirstName">Carrera</label>
								<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; background: rgb(172, 172, 172);"  type="text" id="NombreCarrera" name="NombreCarrera" class="form-control">
									<?php

									$ResuConulta4= $fila['ID_Carrera'];

									$consulta4=$pdo->prepare("SELECT * FROM carrera WHERE Id_Carrera = :Id_Carrera");
									$consulta4->bindParam(":Id_Carrera",$ResuConulta4);
									$consulta4->execute();
									if ($consulta4->rowCount() >=0) 
									{
										utf8_encode($fila4);
										$fila4=$consulta4->fetch()

										?>
										<option  <?php echo 'value="'.$ResuConulta4.'"';  ?> selected > <?php echo $fila4['nombre'];}?> 
									</option>
									<?php     
									foreach($pdo->query('SELECT Id_Carrera,Nombre FROM carrera') as $row) 
									{
										echo '<option  value="'.$row['Id_Carrera'].'">'.$row['Nombre'].'</option>';
									}
									echo '</select>';
									?>
									
								</div>
							</div>
							<div class="col">
								<!-- Last name -->
								<div class="md-form">
									<label for="materialRegisterFormLastName">Class</label>
									<input style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; background: rgb(172, 172, 172);" type="text" id="NClass" name="NClass" class="form-control" <?php echo 'value="'.$fila['Class'] .'"';  ?>>
									
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

										$ResuConulta3= $fila['ID_Empresa'];
										$consulta3=$pdo->prepare("SELECT * FROM empresas WHERE ID_Empresa = :ID_Empresa ");
										$consulta3->bindParam(":ID_Empresa",$ResuConulta3);
										$consulta3->execute();
										if ($consulta3->rowCount() >=0) 
										{
											utf8_encode($fila3);
											$fila3=$consulta3->fetch()

											?>
											<option <?php echo 'value="'.$ResuConulta3.'"';  ?>  selected > <?php echo $fila3['Nombre'];}?> 
										</option>

										<?php 
										foreach($pdo->query("SELECT ID_Empresa,Nombre FROM empresas WHERE Tipo = 'Universidad'") as $row) 
										{
											echo '<option value="'.$row['ID_Empresa'].'">'.$row['Nombre'].'</option>';
										}
										echo '</select>';
										?>
										
									</div>
								</div>
								<div class="col">
									<!-- Last name -->
									<div class="md-form">
										<label  for="materialRegisterFormLastName">Sexo</label>
										<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; text-align: center; background: rgb(172, 172, 172);" 
	 id="Sexo" name="Sexo" class="form-control" >
											<option <?php echo 'value="'.$fila['Sexo'] .'"';?>  selected ><?php echo $fila['Sexo'];?></option>
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
												<input style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; background: rgb(172, 172, 172);"
	 type="text" id="correo" name="correo" class="form-control" <?php echo 'value="'.$fila['correo'] .'"';  }?>>
												
											</div>
										</div>

								<div class="col">
									<!-- Last name -->
									<div class="md-form">
									<label for="materialRegisterFormLastName">Proceso</label>
										<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; text-align: center; background: rgb(172, 172, 172);" 
	 id="IDStatus" name="IDStatus" class="form-control">
											
											<?php 

											$ResuConulta2= $fila['ID_Status'];
											$consulta2=$pdo->prepare("SELECT * FROM status WHERE ID_Status = :ID_Status");
											$consulta2->bindParam(":ID_Status",$ResuConulta2);
											$consulta2->execute();
											if ($consulta2->rowCount() >=0) 
											{
												$fila2=$consulta2->fetch()

												?>
												<option <?php echo 'value="'.$ResuConulta2.'"';  ?>  selected > <?php echo $fila2['Nombre'];}?> 
											</option>

											
											<?php 
											foreach($pdo->query('SELECT ID_Status,Nombre FROM status') as $row) 
											{
												echo '<option value="'.$row['ID_Status'].'">'.$row['Nombre'].'</option>';
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
											<label  for="materialRegisterFormFirstName">Sede</label>
											<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; text-align: center; background: rgb(172, 172, 172);" 
	 type="text" id="sede" name="sede" class="form-control" >
												<?php 

												$ResuConulta= $fila['ID_Sede'];
												$consulta1=$pdo->prepare("SELECT * FROM sedes WHERE ID_Sede = :ID_Sede");
												$consulta1->bindParam(":ID_Sede",$ResuConulta);
												$consulta1->execute();
												if ($consulta1->rowCount() >=0) 
												{
													utf8_encode($fila1);
													$fila1=$consulta1->fetch()
													?>
													<option <?php echo 'value="'.$ResuConulta.'"';  ?>  selected > <?php echo $fila1['Nombre'];}?> 
												</option>

												<?php 
												foreach($pdo->query('SELECT ID_Sede,Nombre FROM sedes') as $row) 
												{

													echo '<option value="'.$row['ID_Sede'].'">'.$row['Nombre'].'</option>';
												}

												echo '</select>';
												?>
												
											</div>
										</div>
									


										<div class="col">
											<!-- First name   Tema , fecha , la hora y el tipo de taller -->
											<div class="md-form">
												<label for="materialRegisterFormFirstName">Lugar Asistencia</label>
												<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px;background: rgb(172, 172, 172);" 
	 type="text" id="Asistencia" name="Asistencia" class="form-control">
													<?php

													$ResuConulta5= $fila['SedeAsistencia'];

													$consulta5=$pdo->prepare("SELECT * FROM sedes WHERE ID_Sede = :ID_Sede");
													$consulta5->bindParam(":ID_Sede",$ResuConulta5);
													$consulta5->execute();
													if ($consulta5->rowCount() >=0) 
													{
														$fila5=$consulta5->fetch()

														?>
														<option <?php echo 'value="'.$ResuConulta5.'"';  ?> selected > <?php echo $fila5['Nombre'];}?> 
													</option>

													?>			

													<option value="SSFT" >San Salvador</option>
													<option value="SAFT" >Santa Ana</option>
												</select>
												
											</div>
										</div>
									</div>

									<div class="form-row">
									<div class="col">
										<!-- Last name -->
										<div class="md-form">
											<label for="materialRegisterFormFirstName">Status actual (A LA FECHA)</label>
											<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; text-align: center; background: rgb(172, 172, 172);" 
	 type="text" id="estadoAlumno" name="statusActual" class="form-control" required >
												<option value="<?php echo $fila['StatusActual'] ?>"selected ><?php echo $fila['StatusActual'] ?></option>
												<option value="Becado" >Becado</option>
												<option value="Declinado" >Declinado</option>
												<option value="Declinado-apoyo extraordinario">Declinado-apoyo extraordinario</option>
												<option value="Beca Denegada" >Beca Denegada</option>
												<option value="Crédito Educativo" >Crédito Educativo</option>
												<option value="Cambio Tipo Carrera Graduado">Cambio Tipo Carrera Graduado</option>
												<option value="Cambio Tipo Carrera No Graduado">Cambio Tipo Carrera No Graduado</option>
												<option value="Beca a la Perseverancia">Beca a la Perseverancia</option>
												<option value="Beca Cancelada">Beca Cancelada</option>
												<option value="Egresado">Egresado</option>
												<option value="Graduado" >Graduado</option>
												<option value="Pausa" >Pausa</option>
												<option value="Fallecido">Fallecido</option>
											</select>	
											
										</div>
									</div>
									<div class="col">
										<div class="md-form">
											<label for="materialRegisterFormFirstName">Fuente de financiamiento</label>
											<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; text-align: center; background: rgb(172, 172, 172);" 
	 type="text" id="financiamiento" name="financiamiento" class="form-control" required >
												<option value="<?php echo $fila['FuenteFinacimiento']?>" selected ><?php echo $fila['FuenteFinacimiento']?></option>
												<option value="Beca Externa con Apoyo Adicional" >Beca Externa con Apoyo Adicional</option>
												<option value="Borja" >Borja</option>
												<option value="FGK" >FGK</option>
												<option value="FOM" >FOM</option>
												<option value="Financiamiento Propio" >Financiamiento Propio</option>
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
												<select style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px;background: rgb(172, 172, 172);"  type="text" id="estadoAlumno" name="estadoAlumno" class="form-control" >
													<option <?php echo 'value="'.$fila['Estado'] .'"';  ?>  selected ><?php echo $fila['Estado'] ;  ?></option>
													<option value="Activo" >Activo</option>
													<option value="Graduado" >Graduado</option>
													<option value="Inactivo" >Inactivo</option>
												</select>	
												
											</div>
										</div>

										<div class="col">
											<div class="md-form">
												<label for="materialRegisterFormFirstName">Cantidad de talleres</label>
												<input style="color: rgb(55, 55, 55); font-size: 18px; border: solid 1px; border-radius: 30px; background: rgb(172, 172, 172);"
	 type="number" name="cantidaTaller" class="form-control" placeholder="Ingrese la cantida de talleres" min="0" required  value="<?php echo $fila['TotalTalleres'] ?>">
												
											</div>
										</div>
									</div>







									

										<input style="color: white; font-size: 18px; border: solid 1px; border-radius: 30px;" type="hidden" name="id"  <?php echo 'value="'.$fila['ID_Alumno'].'"';  ?> >

						<center><button style="border-radius: 20px;
    border: 2px solid #9d120e;
    width: 200px;height: 38px;
     background-color: #9d120e;
     color:white;" name="Guardar_Datos" value="Actualizar Alumno">Actualizar Alumno</button></center>
    <!--<input class="btn btn-primary btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" >-->

					</form>
	<a href="../../LIS-Alumnos.php" style="color: white "><img src="../../img/left-arrow.png" width="40px" height="40px"></a>

				</div>
			</div>
		</div>
	</div>




	
						</body>
						</html>