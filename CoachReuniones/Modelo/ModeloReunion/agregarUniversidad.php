<?php

require_once "../../../BaseDatos/conexion.php";
$idEmpresa = $_POST['idempresa'];
$idReunion = $_POST['idReunion'];
$idEmpresa;
$idReunion;
$contar = 0;
session_start();
$varsesion = $_SESSION['Email'];
$varLugar = $_SESSION['Lugar'];
@$igual = null;
$correo;

// extraer información de txt con mensaje
$file = "../../docs/mensaje_reuniones.txt";
$documento  = file_get_contents($file);
$prettyDocument = trim(($documento));

//
// error_reporting(0);

// inicio de creación de consultas

$stmt2 = "SELECT alumnos.Nombre, alumnos.correo FROM alumnos INNER JOIN
empresas on empresas.ID_Empresa = alumnos.ID_Empresa WHERE alumnos.StatusActual = 'Becado'
AND alumnos.ID_Empresa = ? ";

$stmt3 = "SELECT ID_Empresa FROM universidadreunion WHERE ID_Reunion = ?";


$stmt4 = "INSERT INTO universidadreunion (ID_Reunion, ID_Empresa) VALUES (?,?)";
// fin de creación de consultas


// validar si ya se agrego el id de la universidad a la tabla universiddreunion
$stmt24 = $pdo->prepare($stmt3);
$stmt24->execute([$idReunion]);
while ($row = $stmt24->fetch()) {
    $NombreU = $row["ID_Empresa"];
    if ($idEmpresa == $NombreU) {
        $igual = 1;
        break;
    } else {
        $igual = 0;
    }
}

try {
    if ($igual == 1) {
        $_SESSION['message'] = 'Fallo al agregar, ya se agregó esa Universidad a esta reunión';
        $_SESSION['message2'] = 'danger';
        header("Location: ../../ListaReunion.php?id=" . urlencode($idReunion));
    } else {
        $stmt = $pdo->prepare($stmt4);
        if ($stmt->execute([$idReunion, $idEmpresa])) {
            $result = $pdo->prepare($stmt2);
            if ($result->execute([$idEmpresa])) {
                $alumnos = $result->fetchAll();
                foreach ($alumnos as $key => $value) {
                    $correo = $value['correo'];
                    $cantidad = $contar++;
                    // extraer el primer nombre
                    $PrimerNombre =   implode(' ', array_slice(explode(' ',  $value['Nombre']), 0, 1));

                    // parametros para enviar correo
                    $to = "$correo";
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

                    // Create email headers
                    $headers .= 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion();

                    $subject = "Aviso de Reunion";
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
                  ' . $prettyDocument . '
               </body>
                </html>
                ';
                    if (mail($to, $subject, $message, $headers)) {
                        $contador++;
                    }
                }

                if ($contador >= 1) {
                    $_SESSION['message'] = '¡Se han enviado ' . $contador . '/' . count($correo) . ' Mensajes Enviados!';
                    $_SESSION['message2'] = 'success';
                    header("Location: ../../ListaReunion.php?id=" . urlencode($idReunion));
                } else {
                    $_SESSION['message'] = 'No se pudieron enviar los correos a los alumnos de la universida' . $idEmpresa;
                    $_SESSION['message2'] = 'danger';
                    header("Location: ../../ListaReunion.php?id=" . urlencode($idReunion));
                }
            } else {
                $_SESSION['message'] = "Error al momento de enviar el correo";
                $_SESSION['message2'] = 'danger';
                header("Location: ../../ListaReunion.php?id=" . urlencode($idReunion));
            }
        } else {
            $_SESSION['message'] = 'Fallo al agregar la universidad';
            $_SESSION['message2'] = 'danger';
            header("Location: ../../ListaReunion.php?id=" . urlencode($idReunion));
        }
    }
} catch (\Throwable $th) {
    echo $th;
}
