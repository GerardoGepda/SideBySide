<?php
//inicio de incluir conexion, sesion y idioma
session_start();
include "../../../Conexion/conexion.php";
setlocale(LC_TIME, "spanish");
// fin de incluir conexion, sesion y idioma

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
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                // Create email headers
                $headers .= 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion();

                $subject = utf8_decode("Aviso de renovación de beca");
                // Compose a simple HTML email message
                $message = '<html><body>';
                $message = '<img src="https://i0.wp.com/fundacioncontinua.com/wp-content/uploads/2020/03/FGK.png" alt="Logo" style="width: 60px; height:75px;"><img src="https://workeysoportunidades.org/images/WorkeysBlanco.png" alt="workeys" style="width: 120px; height:50px; padding:2px;">';
                $message .= '<h1 style="color:#BE0032; display: flex;justify-content: center;">Hola ' . $PrimerNombre . ' </h1>';
                $message .= '<p style="display: flex;justify-content: center;">Hemos notado que aún no ha subido su carta de renovación de beca
                a la plataforma Side by Side, le pedimos que suba su carta antes del '.$fechaSpanish.'. </p>';
                $message .= '<p style="display: flex;justify-content: center;"><b>*Este mensaje ha sido generado automáticamente,  por favor no contestar*</b></p>';
                $message .= '<p style="display: flex;justify-content: center;">Att: Coach Fase 2</p>';
                $message .= '<p style="display: flex;justify-content: center;">Dudas o consultas puede escribir al correo: portalworkeys@oportunidades.org.sv</p>';
                $message .= '</body></html>';

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