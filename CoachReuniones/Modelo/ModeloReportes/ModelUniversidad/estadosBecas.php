<?php


error_reporting(0);

include "../../../../BaseDatos/conexion.php";
session_start();

header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);

try {
    $alumnos = [];
    $ciclos = $input['ciclos'];

    foreach ($ciclos as  $value) {
        $row = "'" . $value . "'";
        $sql = "SELECT a.Nombre as nombre, a.ID_Carrera as carrera, a.ID_Empresa as universidad,
        a.StatusActual as estatus, s.last_activity as fecha, u.imagen as img, s.ciclo as ciclo from
       statusbeca s INNER JOIN alumnos a ON a.ID_Alumno = s.ID_Alumno INNER JOIN usuarios u ON 
       u.correo = a.correo WHERE s.ciclo IN ($row)";

        $query2 = $pdo->prepare($sql);
        $query2->execute();

        $cantidad = $query2->rowCount();

        if ($cantidad >= 1) {
            $alumnos = array_merge(array("alumnos" => $query2->fetchAll()));
        }
    }


    $jsondata = json_encode($alumnos);
    echo $jsondata;
} catch (PDOException $err) {
    echo "ERROR: " . $err->getMessage();
}
