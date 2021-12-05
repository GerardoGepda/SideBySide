<?php
//conexion, sesion y idioma
session_start();
include "../../../Conexion/conexion.php";
setlocale(LC_TIME, "spanish");

// inicio de declaración de variables
$fechaActual = date("d-m-Y");
$fechaLimite = date('l jS F Y', strtotime($fechaActual . "+ 5 days"));
$fechaSpanish = strftime("%A, %d de %B de %Y", strtotime($fechaLimite));
$contador = 0;
$correo = [];
// fin de declaración de variables

try {
    // extraer información de txt con mensaje
    $file = "../../docs/notasFaltantes.txt";
    $documento  = file_get_contents($file);
    $prettyDocument = trim(($documento));

    // verificar el el array correo tenga información
    if (isset($_POST['ActuaAlumno'])) {
        $correo = $_POST['ActuaAlumno'];
        $ciclo = $_POST['ciclo'];
        // for para recorrer todos los correos
        for ($i = 0; $i < count($correo); $i++) {
            // dar formato a cada correo
            $email = "'$correo[$i]'";
            // crear consulta para obtener los nombres de los alumnos
            $stmt = $dbh->query("SELECT  Nombre FROM alumnos WHERE correo = $email");

            while ($row = $stmt->fetch()) {
                // extraer el primer nombre
                $PrimerNombre =   implode(' ', array_slice(explode(' ',  $row['Nombre']), 0, 1));
                // parametros para enviar correo
                $to = "$correo[$i]";
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

                $subject = "Aviso de notas faltantes";
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
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
                    <style>
                        .message {
                            /*display: flex;*/
                            margin: 60px auto;
                            justify-content: center;
                            align-items: center;
                            background-color: #2d2d2e;
                            padding: 2%;
                        }
                        p, img{
                            justify-content: center;
                        }
                        .bodyOfMeessage {
                            border-top: 3px #be0032 solid;
                            border-bottom: 3px #be0032 solid;
                            font-family: "Roboto", sans-serif;
                            color: white;
                            margin: 3% 3% 1% 3%;
                            font-size: 10px;
                        }
                        .imgMessage {
                            width: 80%;
                            max-width: 350px;
                            margin: 5px auto;
                        }
                        .imgMessage img {
                            width: 100%;
                        }
                        .footerMessage {
                            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                            font-size: 10px;
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
                            font-size: 13px !important;
                        }
                    </style>
                </head>
                <body>
                    <div class="message">
                        <div class="imgMessage">
                            <center>
                                <img  src="http://portal.workeysoportunidades.org/img/SideBySideWhiteVersion.png" alt="logo side by side">
                            </center>
                        </div>
                        <div class="bodyOfMeessage">
                             <p>¡Hola ' . $PrimerNombre . '</p>
                             ' . $prettyDocument . '
                             <br>
                             <p><b>Notas faltantes:</b> ' . $ciclo . '</p>
                             <p><b>Último día para subir:</b> ' . $fechaSpanish . '</p>
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
                if (mail($to, $subject, $message, $headers)) {
                    $contador++;
                }
            }
        }
        if ($contador >= 1) {
            $_SESSION['message'] = '¡' . $contador . '/' . count($correo) . ' Mensajes Enviados!';
            $_SESSION['message2'] = 'success';
            header("Location: ../../notasFantantes.php");
        } else {
            $_SESSION['message'] = 'No se pudieron enviar los correos selecionados';
            $_SESSION['message2'] = 'danger';
            header("Location: ../../notasFantantes.php");
        }
    } else {
        $_SESSION['message'] = 'Error, No se encontraron alumnos';
        $_SESSION['message2'] = 'danger';
        header("Location: ../../notasFantantes.php");
    }
    // si ocurre algun error el catch lo mostrara en una ventana emergente
} catch (PDOException $Exception) {
    $_SESSION['message'] = $Exception;
    $_SESSION['message2'] = 'danger';
    header("Location: ../../notasFantantes.php");
}
