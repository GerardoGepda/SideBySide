<?php 

require_once "../BaseDatos/conexion.php";
session_start();

if(isset($_POST['todoasis']))
{
	$Asis = "Asistio";
	$IDTaller = $_POST['idtaller'];
	$alumnos =$_POST["ActuaAlumno"];

	if($alumnos == null)
	{
		$alumnos = 0;
		header("Location: ListaReunion.php?id=".urlencode($IDTaller));
	}

	for ($i=0;$i<count($alumnos);$i++)
	{

		$consulta=$pdo->prepare("UPDATE inscripcionreunion  SET   asistencia=:asistencia   WHERE id_alumno =:id_alumno AND id_reunion = :id_reunion");
		$consulta->bindParam(":asistencia",$Asis);
		$consulta->bindParam(":id_alumno",$alumnos[$i]);
		$consulta->bindParam(":id_reunion",$IDTaller);

                 //Verifica si ha insertado los datos
		if ($consulta->execute()) 
		{   
			$_SESSION['message'] = 'Se colocó la asistencia';
			$_SESSION['message2'] = 'success';
			header("Location: ListaReunion.php?id=".urlencode($IDTaller));
		}
		else
		{
			$_SESSION['message'] = 'No se colocó la asistencia';
			$_SESSION['message2'] = 'danger';
			header("Location: ListaReunion.php?id=".urlencode($IDTaller));
		}

	}


}
else if(isset($_POST['todoinasis']))
{
	$Asis = "Inasistencia";
	$IDTaller = $_POST['idtaller'];
	$alumnos =$_POST["ActuaAlumno"];

	if($alumnos == null)
	{
		$alumnos = 0;	
		header("Location: ListaReunion.php?id=".urlencode($IDTaller));
	}

	for ($i=0;$i<count($alumnos);$i++)
	{
		$consulta=$pdo->prepare("UPDATE inscripcionreunion  SET   asistencia=:asistencia   WHERE id_alumno =:id_alumno AND id_reunion = :id_reunion");
		$consulta->bindParam(":asistencia",$Asis);
		$consulta->bindParam(":id_alumno",$alumnos[$i]);
		$consulta->bindParam(":id_reunion",$IDTaller);

        //Verifica si ha insertado los datos
		if ($consulta->execute()) 
		{   
			sendMails($pdo, $alumnos, $IDTaller);
		}
		else
		{
			$_SESSION['message'] = 'No se colocó la inasistencia';
			$_SESSION['message2'] = 'danger';
			header("Location: ListaReunion.php?id=".urlencode($IDTaller));
		}

	}
}


function sendMails($pdo, $alumnos, $IDTaller) {
	setlocale(LC_TIME, "spanish");
	// inicio de declaración de variables
	$fechaActual = date("d-m-Y");
	$fechaLimite = date('l jS F Y', strtotime($fechaActual . "+ 5 days"));
	$fechaSpanish = strftime("%A, %d de %B de %Y", strtotime($fechaLimite));
	$contador = 0;
	// fin de declaración de variables

	try {
		// for para recorrer todos los id de alumnos
		for ($i = 0; $i < count($alumnos); $i++) {
			// dar formato a cada correo
			$idAlm = "'$alumnos[$i]'";
			// crear consulta para obtener los nombres de los alumnos
			$stmt = $pdo->query("SELECT Nombre, correo, Titulo FROM alumnos al INNER JOIN inscripcionreunion inreu
			ON al.ID_Alumno = inreu.id_alumno
			INNER JOIN reuniones reu
			ON reu.ID_Reunion = inreu.id_reunion
			WHERE al.ID_Alumno = $idAlm AND reu.ID_Reunion = '$IDTaller' GROUP BY al.Nombre");
			
			while ($row = $stmt->fetch()) {
				// extraer el primer nombre
				$PrimerNombre =   implode(' ', array_slice(explode(' ',  $row['Nombre']), 0, 1));
				//extraer correos
				$correo = $row['correo'];
				$tituloReu = $row['Titulo'];
				// parametros para enviar correo
				$to = "$correo";
				$from = "SideBySide@oportunidades.org.sv";
				// To send HTML mail, the Content-type header must be set
				$headers = "Reply-To: '$from'\r\n";
				$headers .= "Return-Path: $from\r\n";
				$headers .= "From: $from\r\n";
				$headers .= "Organization: Oportunidades\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=UFT-8\r\n";
				$headers .= "X-Priority: 1\r\n";
				$headers .= "X-MSMail-Priority: High\n";
				$headers .= "Importance: High\n";
				$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

				// Create email headers
				$headers .= 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion();

				$subject = "Aviso de inasistencia a reunión";
				// Compose a simple HTML email message
				$message = '
				<!DOCTYPE html>
				<html lang="es">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<link rel="preconnect" href="https://fonts.googleapis.com">
					<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
					<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet"> 
					<style>
						.message {
							display: flex;
							flex-direction: column !important;
							justify-content: center;
							align-items: center;
							background-color: #2d2d2e;
							padding: 2%;
						}
						.bodyOfMeessage {
							border-top: 3px #be0032 solid;
							border-bottom: 3px #be0032 solid;
							font-family: "Roboto", sans-serif;
							color: white;
							margin: 3% 3% 1% 3%;
							font-size: 9px;
						}
						.imgMessage {
							width: 80%;
							max-width: 350px;
						}
						.imgMessage img {
							width: 100%;
						}
						.footerMessage {
							font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
							font-size: 9px;
							color: white;
							margin-bottom: 1%;
						}
						.btnportal {
							background-color: #be0032;
							color: white;
							display: inline-block;
							width: 100px;
							height: 25px;
							text-decoration: none;
							padding-top: 5px;
							border-radius: 5px;
							font-size: 14px !important;
						}
					</style>
				</head>
				<body>
					<div class="message">
						<div class="imgMessage">
							<img src="http://portal.workeysoportunidades.org/img/SideBySideWhiteVersion.png" alt="logo side by side">
						</div>
						<div class="bodyOfMeessage">
							<p>¡Hola '.$PrimerNombre.'!</p>
							<p>Hemos notado que no asistió a la reunión "'.$tituloReu.'". Le pedimos que se comunique con el coach de su correspondiente sede antes del ' . $fechaSpanish . ', de lo contrario tendrá repercusiones en su renovación de beca.</p>
							<p>Dudas o consultas puede escribir al correo: SideBySide@oportunidades.org.sv</p>
							<p>Att: Equipo fase 2</p>
							<center><a class="btnportal" href="http://portal.workeysoportunidades.org/" target="_blank">Ir al portal</a></center>
							<br>
						</div>
						<div class="footerMessage">
							<center><b>Este mensaje ha sido generado automáticamente,  por favor no contestar</b></center>
						</div>
					</div>
				</body>
				</html>
				';
				// si el mensaje se envia aumentara en 1 el contador 
				if (mail($to, utf8_decode($subject), $message, $headers)) {
					$contador++;
				}
			}
		}
		if ($contador >= 1) {
			$_SESSION['message'] = 'Se colocó la inasistencia. ¡' . $contador . '/' . count($alumnos) . ' Mensajes Enviados!';
			$_SESSION['message2'] = 'success';
			header("Location: ListaReunion.php?id=".urlencode($IDTaller));
		} else {
			$_SESSION['message'] = 'No se pudieron enviar los correos selecionados';
			$_SESSION['message2'] = 'danger';
			header("Location: ListaReunion.php?id=".urlencode($IDTaller));
		}
		// si ocurre algun error el catch lo mostrara en una ventana emergente
	} catch (PDOException $Exception) {
		$_SESSION['message'] = $Exception;
		$_SESSION['message2'] = 'danger';
		header("Location: ListaReunion.php?id=".urlencode($IDTaller));
	}
}

?>