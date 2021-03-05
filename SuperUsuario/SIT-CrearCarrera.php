<?php
include("../BaseDatos/conexion.php"); //Realizamos la conexión con la base de datos
//Modularidad para inicializar el Head y <!DOCTYPE html>
include 'Modularidad/CabeceraInicio.php';
error_reporting(0);
?>
<title>Crear Carreras</title>
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
.submenu1{
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
.icon{
	

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
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon1 {
    float: right;
    display: inline-block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
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
  .titulomenu a{
    font-size: 15px;
  }
}
</style>
<?php
//Modularaidad para extraere los enlaces en HEAD
include 'Modularidad/EnlacesCabecera.php';
//Incluir el menu horizontal
//include 'Modularidad/MenuHorizontal.php';
include 'Modularidad/MenuVertical.php';
?>
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
<!--Comiezo de estructura de trabajo -->
<div class="container-fluid ">


	<div class="topnav" id="myTopnav">
  <a href="javascript:history.back();"><img src="../img/proximo.svg" class="icon"></a>
  <a  class="titulomenu" style="background-color:#ADADB2; color: #2D2D2E; font-size: 25px;">Creación de carrera</a>
  <a href="SIT-CrearEmpresas.php" class="submenu1">Empresas</a>
  <a href="SIT-CrearCarrera.php" class="submenu1">Carrera</a>
  <a href="SIT-Facultades.php" class="submenu1">Facultades</a>
  <a href="javascript:void(0);" class="icon1" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

	
	</div>
	<!-- Collapsible content -->

<div class="float-right"> <?php include 'Modularidad/Alerta.php'?></div>

<div class="float-right">
<?php include 'Modularidad/AlertaCorreo.php'?>	
</div>
<!-- Comienzo del MODAL DEL FORMULARIO -->
<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel" style="color: black">Nueva carrera</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form action="Modelo/ModeloCarrera/GuardarDatosCarreras.php" method="POST" accept-charset="utf-8">
					<div id="alerta5"></div>
					<div class="col">
						<!-- First name   Tema , fecha , la hora y el tipo de taller -->
						<div class="md-form">
							<label for="materialRegisterFormFirstName" style="color: black" >Nombre de Carrera</label>
							<input type="text" id="NomCarr" name="NomCarr" class="form-control" placeholder="Nombre completo de la carrera" required>
							
						</div>

						<div class="md-form">
							<label for="materialRegisterFormFirstName" style="color: black" >Nombre de la Facultad</label>
							<select id="Faculta" name="Faculta" class="form-control" required >
								<?php     
								echo '<option value="" disabled selected >Seleccione la opción</option>';
								foreach($pdo->query('SELECT IDFacultates,Nombre FROM facultades') as $row) 
								{
									echo '<option value="'.$row['IDFacultates'].'">'.utf8_encode($row['Nombre']).'</option>';
								}
								echo '</select>';
								?>

							</select>

							
						</div>
					</div>


					<div class="col">
						<!-- First name   Tema , fecha , la hora y el tipo de taller -->
						<div class="md-form">
							<label for="materialRegisterFormFirstName" style="color: black" >Duración Carrera</label>
							<select id="duracion" name="duracion" class="form-control" required>
								<option value="" disabled selected >Seleccione la opción</option>
								<option value="Corta Duración">Corta Duración</option>
								<option value="Larga Duración">Larga Duración</option>
							</select>
							
						</div>
					</div>
					<br>
					<center><button name="Guardar_Carrera" value="Crear Carrera" id="Guardar_Carrera" style="border-radius: 20px;
    border: 2px solid #9d120e;
    width: 200px;height: 38px;
     background-color: #9d120e;
     color:white; ">Crear Carrera</button></center>
     <!--<input class="btn btn-primary btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" >-->
				</form>
			</div>
		</div>
	</div>
</div>
<!-- FIN DEL MODAL -->

<br>
<div class="card">
	<h5 class="card-header" style="color: black;"> Lista de carreras 

		<span class="float-right">	
			<button type="button" class="btn btn-danger px-3" data-toggle="modal" data-target="#exampleModal2" style="border-radius: 20px;
    border: 2px solid #9d120e;
    width: 200px;height: 38px;
     background-color: #9d120e;
     color:white; ">
				<i class="fas fa-book"></i>
				 Nueva Carrera
			</button>
		</span>
	</h5>	
	<div class="card-body">
		<div class="table-responsive">
			<br>
			<table  id="tableUser" class="table table-hover table-sm table-bordered table-fixed" >
				<thead class="thead-dark">
					<tr>  
						<th scope="col">Codigo</th>
						<th scope="col">Carrera</th>
						<th scope="col">Duración</th>
						<th scope="col">Facultadad</th>
						<th scope="col">Actualizar</th>
						<th scope="col">Eliminar</th>
					</tr>
				</tr>
			</thead>
			<tfoot class="thead-dark">
				<tr>
					<th scope="col">Codigo</th>
					<th scope="col">Carrera</th>
					<th scope="col">Duración</th>
					<th scope="col">Facultadad</th>
					<th scope="col">Actualizar</th>
					<th scope="col">Eliminar</th>
				</tr>
			</tr>
		</tfoot>
		<tbody>
			<?php
			require_once 'Modelo/ModeloCarrera/MostrarDatosCarreras.php';
			?>

		</tbody>        
	</table>  

</div> <!--Fin de la caja responsivo de la tabla-->

</div>
</div>

<br><br>
<?php
//Incluir el footer
include 'Modularidad/PiePagina.php';
?>
