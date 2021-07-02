<?php

session_start();  
$varsesion = $_SESSION['Email'];
$varLugar = $_SESSION['Lugar'];



$InicialDep = $varLugar [0]; // Extraemos la primera letra
$FinalDep = $varLugar [1]; // Extraemos la segunda letra

//Concatenamos
$FullTime = "FT";
$Sabatino = "SAT";

$LugarFT=$InicialDep . $FinalDep . $FullTime; //Ejemplo SSFT
$LugarSAT=$InicialDep . $FinalDep .$Sabatino; //Ejemplo SSSAT

//$Lugar2="SSSAT";
//<td><input type='checkbox' name='ActuaAlumno[]' class='case' value=".$fila['ID_Alumno']."></td>

	// Consulta De La BASE DE DATOS
	$consulta=$pdo->prepare("SELECT * FROM alumnos ");
	
	$consulta->execute();

	if ($consulta->rowCount()>=1)
	{
		while ($fila=$consulta->fetch())
			{		
				$Asistencia;
				if ($fila['SedeAsistencia'] == "SSFT") {
					$Asistencia = "San Salvador";
				}else
				{
					$Asistencia = "Santa Ana";
				}

				echo "
		<tr class='table-light'>
		<td>".$fila['ID_Alumno']."</td>
		<td>".$fila['Nombre']."</td>
		<td>".$fila['Class']."</td>
		<td>".$fila['ID_Sede']."</td>
		<td>".$Asistencia."</td>
		<td>".$fila['StatusActual']."</td>
		<td>".$fila['Estado']."</td>
		<td><a href='AlumnoInicio.php?id=".$fila['correo']."' class='btn ' style='background-color:#BE0032'><i class='fa fa-eye'></i></a></td>
		<td><a href='ModificarBeca.php?id=".$fila['correo']."' class='btn btn-warning'><i class='fa fa-user-edit'></i></a></td>
		</tr>";

	}
}
