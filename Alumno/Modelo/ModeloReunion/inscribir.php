<?php
error_reporting(0);
require_once "../../../BaseDatos/conexion.php";
session_start();



if (isset($_POST['inscribir'])) {

    //extraccion de datos por metodo POST
    $idalumno = trim($_POST['alumno']);
    $id = trim($_POST['id']);
    $telefono = trim($_POST['telefono']);
    $horario = trim($_POST['horario']);
    $reunion = trim($_POST['reunion']);

    $sql2 = "UPDATE `inscripcionreunion` SET `id_alumno`= ? ,`telefono`= ?,`asistencia`= ?, 
    `estado`= ? WHERE `id`= ? and `horario` = ?  ";

    if ($pdo->prepare($sql2)->execute([$idalumno, $telefono, 'En espera', 'lleno', $id, $horario])) {
        $stmt = $pdo->query("SELECT * FROM horariosreunion where ID_Reunion = $reunion
         and IDHorRunion = $horario");
        while ($row = $stmt->fetch()) {
            $cantidad = $row['Canitdad'];
        }
        $result = $cantidad - 1;
        $sql3 = "UPDATE `horariosreunion` SET `Canitdad`= ? WHERE ID_Reunion = ? and 	IDHorRunion = ?";

        if ($pdo->prepare($sql3)->execute([$result, $reunion, $horario])) {
            header("Location: ../../listadoxReunion.php?id=$horario&reunion=$reunion");
            $_SESSION['message'] = 'La inscripción se ha guardado';
            $_SESSION['message2'] = 'success';
        } else {
            $_SESSION['message'] = 'Error en la cantidad de cupos';
            $_SESSION['message2'] = 'danger';
            header("Location: ../../listadoxReunion.php?id=$horario&reunion=$reunion");
        }
    } else {
        $_SESSION['message'] = 'Cupo lleno';
        $_SESSION['message2'] = 'Error';
        header("Location: ../../listadoxReunion.php?id=$horario&reunion=$reunion");
    }
} else {
    $_SESSION['message'] = 'No se han enviado datos para procesar';
    $_SESSION['message2'] = 'danger';
    header("Location: ../../listadoxReunion.php?id=$horario&reunion=$reunion");
}
