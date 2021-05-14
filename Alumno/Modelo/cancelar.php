<?php
error_reporting(0);
require_once "../../BaseDatos/conexion.php";
session_start();



//extraccion de datos por metodo POST
$id = trim($_GET['id']);
$reunion = trim($_GET['reunion']);
$horario = trim($_GET['horario']);

$sql2 = "UPDATE `inscripcionreunion` SET `id_alumno`= ? ,`telefono`= ?,`asistencia`= ?, `estado`= ? WHERE `id`= ? ";

if ($pdo->prepare($sql2)->execute([null, '0000-0000', null, 'disponible', $horario])) {
    $_SESSION['message'] = 'Usted se ha desinscrito de la reunión';
    $_SESSION['message2'] = 'success';
    header("Location: ../listadoxReunion.php?id=$id&reunion=$reunion");
} else {
    $_SESSION['message'] = 'Cupo lleno';
    $_SESSION['message2'] = 'Error';
    header("Location: ../listadoxReunion.php?id=$id&reunion=$reunion");
}
