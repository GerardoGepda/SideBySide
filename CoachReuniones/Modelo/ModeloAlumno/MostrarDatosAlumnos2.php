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

	// Consulta De La BASE DE DATOS
	$consulta=$pdo->prepare("SELECT * FROM alumnos LEFT JOIN carrera ON alumnos.ID_Carrera = carrera.Id_Carrera ");
	
	$consulta->execute();

	if ($consulta->rowCount()>=1)
	{
		while ($fila=$consulta->fetch())
			{		
			
				echo "
		<tr class='table-light'>		
			<th>".($fila['Nombre'])."</th>
			<th>".$fila['Sexo']."</th>
			<th>".$fila['Class']."/".$fila['ID_Sede']."</th>
			<td>".($fila['nombre'])."</td>
			<td>".$fila['CantidadModulos']."/6</td>
			<td>".$fila['TotalTalleres']."</td>	
			<th>".$fila['EstadoCerti']."</th>
			<th><form action='cambiardatos.php' method='post'><button type='submit' name='id' value='".$fila['ID_Alumno']."' class='btn btn-warning' ><i class='far fa-edit'></i></button></form></th>
		</tr>";

	}
}
?>

