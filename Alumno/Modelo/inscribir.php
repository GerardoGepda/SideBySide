<?php
error_reporting(0);
require_once "../../BaseDatos/conexion.php";
session_start();



if (isset($_POST['inscribir'])) {

//extraccion de datos por metodo POST
    $idalumno = trim($_POST['alumno']);
    $id = trim($_POST['id']);
    $telefono = trim($_POST['telefono']);
    $horario = trim($_POST['horario']);
    $reunion = trim($_POST['reunion']);

    $sql2 = "UPDATE `inscripcionreunion` SET `id_alumno`= ? ,`telefono`= ?,`asistencia`= ?, `estado`= ? WHERE `id`= ? ";

    if ($pdo->prepare($sql2)->execute([$idalumno, $telefono, 'En espera', 'lleno', $id])) {
        $_SESSION['message'] = 'La inscripción se ha guardado';
        $_SESSION['message2'] = 'success';
        header("Location: ../listadoxReunion.php?id=$horario&reunion=$reunion");
    } else {
        $_SESSION['message'] = 'Cupo lleno';
        $_SESSION['message2'] = 'Error';
        header("Location: ../listadoxReunion.php?id=$horario&reunion=$reunion");
    }
} else {
    $_SESSION['message'] = 'No se han enviado datos para procesar';
    $_SESSION['message2'] = 'danger';
    header("Location: ../listadoxReunion.php?id=$horario&reunion=$reunion");
}
