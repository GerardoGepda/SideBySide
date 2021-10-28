<?php


require_once "../../../BaseDatos/conexion.php";
session_start();
$varsesion = $_SESSION['Email'];
$varLugar = $_SESSION['Lugar'];

if (isset($_POST['EnviarDato'])) {
	$IDSolicitud = $_POST['id'];
	$Comentario = $_POST['comentario'];
	$Estado = $_POST['estado'];

	$Correo = $_POST['correo'];
	$NombreAlu = $_POST['nombreEst'];

	try {
		$consulta = $pdo->prepare("UPDATE hsociales SET estado=:estado , comentario = :comentario WHERE ID_HSociales=:id");
		$consulta->bindParam(":estado", $Estado);
		$consulta->bindParam(":comentario", $Comentario);
		$consulta->bindParam(":id", $IDSolicitud);

		$PrimerNombre = explode(" ", $NombreAlu)[0];

		$to = "$Correo";
		$from = "SideBySide@oportunidades.org.sv";
		// To send HTML mail, the Content-type header must be set
		$headers .= "Reply-To: '$from'\r\n";
		$headers .= "Return-Path: $from\r\n";
		$headers .= "From: $from\r\n";
		$headers .= "Organization: Oportunidades\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=UFT-8\r\n";
		$headers .= "X-Priority: 1\r\n";
		$headers .= "X-MSMail-Priority: High\n";
		$headers .= "Importance: High\n";
		$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

		$subject = "Solicitud de horas de vinculación";
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
					<p>Hemos recibido tu solicitud de horas de vinculación. Tu solicitud ya fue revisada y el estado de esta es: '.$Estado.'</p>
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
		
		//Verifica si ha insertado los datos
		if ($consulta->execute()) {
			if (mail($to, $subject, $message, $headers)) {
				//Si todo fue correcto muestra el resultado con exito;
				$_SESSION['message'] = 'Solicitud Actualizada con exito';
				$_SESSION['message2'] = 'success';
				header("Location: ../../DetallesHorasSociales.php?id=" . urlencode($IDSolicitud));
			}else {
				$_SESSION['message'] = 'Solicitud Actualizada pero error en envío de correo a alumno';
				$_SESSION['message2'] = 'danger';
				header("Location: ../../DetallesHorasSociales.php?id=" . urlencode($IDSolicitud));
			}
		} else {
			$_SESSION['message'] = 'Solicitud No Actualizdo';
			$_SESSION['message2'] = 'danger';
			header("Location: ../../DetallesHorasSociales.php?id=" . urlencode($IDSolicitud));
		}
	} catch (PDOException $err) {
		
	}
} else {
	$_SESSION['message'] = 'Datos No ingresados VerficarSolicuitud.php';
	$_SESSION['message2'] = 'danger';
	header("Location: ../../DetallesHorasSociales.php?id=" . urlencode($IDSolicitud));
}
