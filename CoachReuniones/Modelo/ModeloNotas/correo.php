<?php
//conexion, sesion y idioma
session_start();
include "../../../Conexion/conexion.php";
setlocale(LC_TIME, "spanish");

// inicio de declaración de variables
$fechaActual = date("d-m-Y");
$fechaLimite = date('l jS F Y', strtotime($fechaActual . "+ 3 days"));
$fechaSpanish = strftime("%A, %d de %B de %Y", strtotime($fechaLimite));
$contador = 0;
$correo = [];
// fin de declaración de variables

try {
    // verificar el el array correo tenga información
    if (isset($_POST['ActuaAlumno'])) {
        $correo = $_POST['ActuaAlumno'];

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
                $from = "portalworkeys@oportunidades.org.sv";
                // To send HTML mail, the Content-type header must be set
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

                // Create email headers
                $headers .= 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion();

                $subject = utf8_decode("Aviso de renovación de beca");
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
                            flex-direction: column;
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
                            font-size: 14px;
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
                            font-size: 13px;
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
                        }
                    </style>
                </head>
                <body>
                    <div class="message">
                        <div class="imgMessage">
                            <img src="http://portal.workeysoportunidades.org/img/SideBySideWhiteVersion.png" alt="logo side by side">
                        </div>
                        <div class="bodyOfMeessage">
                            <p>¡Hola nombre '.$PrimerNombre.'!</p>
                            <p>Hemos notado que aún no has subido tus notas del ciclo 01 2021 a la plataforma Side by Side, por lo cual le solicitados que las suba antes del '.$fechaSpanish.'.</p>
                            <p>Dudas o consultas puede escribir al correo: portalworkeys@oportunidades.org.sv</p>
                            <p>Att: Coach fase 2</p>
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
                if (mail($to, $subject, utf8_decode($message), $headers)) {
                    $contador++;
                }
            }
        }
        if ($contador >= 1) {
            $_SESSION['message'] = '¡' . $contador . '/' . count($correo) . ' Mensajes Enviados!';
            $_SESSION['message2'] = 'success';
            header("Location: ../../renovaciones2.php");
        } else {
            $_SESSION['message'] = 'No se pudieron enviar los correos selecionados';
            $_SESSION['message2'] = 'danger';
            header("Location: ../../renovaciones2.php");
        }
    } else {
        $_SESSION['message'] = 'Error, No se encontraron alumnos';
        $_SESSION['message2'] = 'danger';
        header("Location: ../../renovaciones2.php");
    }
    // si ocurre algun error el catch lo mostrara en una ventana emergente
} catch (PDOException $Exception) {
    $_SESSION['message'] = $Exception;
    $_SESSION['message2'] = 'danger';
    header("Location: ../../renovaciones2.php");
}
