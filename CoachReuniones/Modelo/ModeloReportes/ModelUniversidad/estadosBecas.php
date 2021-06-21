<?php


//error_reporting(0);

include "../../../../BaseDatos/conexion.php";
session_start();

header("Content-type: application/json; charset=utf-8");

try {
    $alumnos = [];

    $sql = "SELECT a.ID_Alumno as IDalumno, a.Nombre as nombre, a.Class as class, a.ID_Sede as sede, a.FuenteFinacimiento FFinanciamiento, c.nombre 
        as carrera, a.ID_Empresa as universidad, a.StatusActual as estatus, s.last_activity as fecha, u.imagen as img, s.ciclo 
        as ciclo from statusbeca s INNER JOIN alumnos a ON a.ID_Alumno = s.ID_Alumno INNER JOIN usuarios u 
        ON u.correo = a.correo INNER JOIN carrera c ON c.Id_Carrera = a.ID_Carrera";

    $query2 = $pdo->prepare($sql);
    $query2->execute();

    $cantidad = $query2->rowCount();

    /*
    if ($cantidad >= 1) {
        $alumnos = array_merge(array("alumnos" => $query2->fetchAll()));
    }
    */  
    $alumnos = array_merge(array("alumnos" => $query2->fetchAll(PDO::FETCH_NUM)));

    $jsondata = json_encode($alumnos);
    echo $jsondata;
} catch (PDOException $err) {
    echo "ERROR: " . $err->getMessage();
}
