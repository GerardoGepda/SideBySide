<?php
require_once "../../../BaseDatos/conexion.php";
setlocale(LC_TIME, 'es_SV.UTF-8');
date_default_timezone_set("America/El_Salvador");
session_start();

function InscribirCiclo($idCiclo, $idExpediente, $ciclo, $filename, PDO $pdo)
{
	//consulta para insertar solicitud de transporte
    $consulta = $pdo->prepare("INSERT INTO inscripcionciclos (Id_InscripcionC, idExpedienteU, cicloU, comprobante) VALUES(:Id_InscrpC, :idExpdtU, :ciclo, :comprobante)");

	$consulta->bindParam(':Id_InscrpC', $idCiclo);
	$consulta->bindParam(':idExpdtU', $idExpediente);
	$consulta->bindParam(':ciclo', $ciclo);
	$consulta->bindParam(':comprobante', $filename);
	$result = $consulta->execute();

	return $result;
}

function CreateNoti(PDO $pdo, $expdt){
	//preparamos receptor
	$mailReceptor = $_SESSION['Email'];
	echo $_SESSION['Email'];
	$exctReceptor = $pdo->prepare("SELECT IDUsuario, nombre, correo FROM usuarios WHERE correo = '$mailReceptor'");
	$exctReceptor->execute();

	while ($fila = $exctReceptor->fetch()) {
		$idReceptor = $fila['IDUsuario'];
	}

	//Insertamos notificacion
	$queryNoti = $pdo->prepare("INSERT INTO notificaciones (`Id_Remitente`, `Id_Receptor`, `Tipo`,`idSolicitud`) VALUES (:idRemitente, :idReceptor,'Proceso de inscripción', :idSoli)");
	$result = $queryNoti->execute(array(":idRemitente" => '969' ,":idReceptor" => $idReceptor, ":idSoli" => $expdt));

	return $result;
}


//Guardar solicitud
if(isset($_POST['Guardar_InscriCiclo']))
{	
	
	//variables del form para inscribir ciclo
	$expediente = $_POST['expediente'];
	$idCicloInscripcion = $_POST['inscriCiclo'];
	$ciclo = $_POST['ciclo'];
	$iduser = $_POST['alumno'];

	$nombrearchivo = $_FILES["archivo"]["name"];
	$tipoarchivo = $_FILES["archivo"]["type"];
	$tamanioarchivo = $_FILES["archivo"]["size"];
	$rutaarchivo = $_FILES["archivo"]["tmp_name"];
	$destino = "../../../pdfCicloInscripcion/";

	//Variable que contendra el archivo
	$ArchivoPDF;

	//Verificando tamanio de archivo
	if ($tamanioarchivo <= 5000000) {
		
		//creamos el destino si no se encuentra
		if(!file_exists($destino)){
            mkdir($destino);
        }

		$filename = $iduser. "-" .$ciclo.".pdf";
		$destino .= $filename;

		//agregamos el archivo a su carpeta de destino y evaluamos el exito
		if (copy($rutaarchivo, $destino)) {
			
			//hacemos la consulta de insercion y evaluamos el resultado
			$result = InscribirCiclo($idCicloInscripcion, $expediente, $ciclo, $filename, $pdo);
			if ($result) {
				//creamos una cookie con los datos de la inscripcion
				setcookie("InscrpCiclo[idInscrip]", $idCicloInscripcion, time() + 604800, "/");
				setcookie("InscrpCiclo[idExpdt]", $expediente, time() + 604800, "/");
				setcookie("InscrpCiclo[ciclo]", $ciclo, time() + 604800, "/");
				setcookie("InscrpCiclo[alumnoCarnet]", $iduser, time() + 604800, "/");

				//creamos la notificacion del proceso de inscipción
				//CreateNoti($pdo, $expediente);

				//Redirigimos a la pantalla de materias
				header("Location: ../../InscripcionMateriasCiclo.php");
			}else {
				$_SESSION['message'] = 'Error al guardar su ciclo en la DB, contacte con un administrador';
				$_SESSION['message2'] = 'danger';
				header("Location: ../../IndicacionesMaterias.php");
			}
		}else {
			$_SESSION['message'] = 'Error al guardar su archivo PDF en el host, contacte con un administrador';
			$_SESSION['message2'] = 'danger';
			header("Location: ../../IndicacionesMaterias.php");
		}
	}else {
		$_SESSION['message'] = 'El tamaño de su archivo PDF sobrepasa el limite permitido (5 MB)';
		$_SESSION['message2'] = 'warning';
		header("Location: ../../IndicacionesMaterias.php");
	}
}
else
{
	header("location: ../../IndicacionesMaterias.php");
}








?>