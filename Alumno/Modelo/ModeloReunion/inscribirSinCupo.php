<?php
error_reporting(0);
require_once "../../../BaseDatos/conexion.php";
session_start();

//var_dump($_POST);

if (isset($_POST['idreunion'])) {
    //extraccion de datos por metodo POST
    $idalumno = trim($_POST['idalumno']);
    $reunion = trim($_POST['idreunion']);
    $horario = trim($_POST['horario']);
    $telefono = trim($_POST['telefono']);
    $horainicio = trim($_POST['hinicio']);
    $horafin = trim($_POST['hfin']);
    $estado = trim($_POST['estado']); 

    $sql = "SELECT COUNT(id_alumno) AS inscrito FROM inscripcionreunion WHERE id_alumno = ? AND id_reunion = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$idalumno, $reunion]);
    $row = $query->fetch();
    $reult = (int)$row[0];
    
    if ($reult == 0) {
        $sql2 = "INSERT INTO `inscripcionreunion`(`id_alumno`, `id_reunion`, `Horario`, `telefono`, `asistencia`, `horainicio`, `horafin`, `estado`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        try {
            $query = $pdo->prepare($sql2);
            $ingresado = $query->execute([$idalumno, $reunion, $horario, $telefono, "En espera", $horainicio, $horafin, "lleno"]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        if ($ingresado) {
            echo "¡Inscripción exitosa!";
        } else {
            echo "Erro al guardar su inscripción en, intente de nuevo.";
        }
    } else {
        echo "Ya esta inscrito en esta reunión.";
    }

} else {
    echo "Error en el envio de datos.";
}
