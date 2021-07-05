<?php
session_start();
error_reporting(0);
include "../../../Conexion/conexion.php";

if (isset($_POST['ActuaAlumno'])) {
    $correo = $_POST['ActuaAlumno'];
    // var_dump($correo);
    $_SESSION['message'] = '¡Mensaje Enviado!';
    $_SESSION['message2'] = 'success';
    header("Location: ../../renovaciones2.php");
}
