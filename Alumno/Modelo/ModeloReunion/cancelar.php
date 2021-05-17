<?php
error_reporting(0);
require_once "../../../BaseDatos/conexion.php";
session_start();



//extraccion de datos por metodo POST
$id = trim($_GET['id']);
$reunion = trim($_GET['reunion']);
$horario = trim($_GET['horario']);

$sql2 = "UPDATE `inscripcionreunion` SET `id_alumno`= ? ,`telefono`= ?,`asistencia`= ?, `estado`= ? WHERE `id`= ? ";

if ($pdo->prepare($sql2)->execute([null, '0000-0000', null, 'disponible', $horario])) {
    $_SESSION['message'] = 'Usted se ha desinscrito de la reunión';
    $_SESSION['message2'] = 'success';

    $stmt = $pdo->query("SELECT * FROM horariosreunion where ID_Reunion = $reunion and IDHorRunion = $id");
    while ($row = $stmt->fetch()) {
        $cantidad = $row['Canitdad'];
    }
    $result = $cantidad + 1;
    $sql3 = "UPDATE `horariosreunion` SET `Canitdad`= ? WHERE ID_Reunion = ? and 	IDHorRunion = ?";

    if ($pdo->prepare($sql3)->execute([$result, $reunion, $id])) {
        header("Location: ../../listadoxReunion.php?id=$id&reunion=$reunion");
        $_SESSION['message'] = 'La inscripción se ha guardado';
        $_SESSION['message2'] = 'success';
    } else {
        $_SESSION['message'] = 'Error en la cantidad de cupos';
        $_SESSION['message2'] = 'danger';
        header("Location: ../../listadoxReunion.php?id=$id&reunion=$reunion");
    }


    header("Location: ../../listadoxReunion.php?id=$id&reunion=$reunion");
} else {
    $_SESSION['message'] = 'Cupo lleno';
    $_SESSION['message2'] = 'Error';
    header("Location: ../../listadoxReunion.php?id=$id&reunion=$reunion");
}
