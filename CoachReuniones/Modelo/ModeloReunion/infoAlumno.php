<?php

include_once "../../../Conexion/conexion.php";
session_start();

$FotoAlumno = '';
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
$data = array();
$id = $input['id'];


$sql1 = "SELECT `ID_Alumno` , A.correo as 'correo' , A.Nombre AS 'Alumno',  A.ID_Empresa AS 'idem' , em.Nombre AS 'Universidad', 
A.Id_Carrera AS 'idUni', C.nombre AS 'CARRERA' ,C.Duracion, u.imagen,  F.Nombre 'Facultad'   FROM alumnos A INNER JOIN empresas E ON A.ID_Empresa = E.ID_Empresa
INNER JOIN carrera C ON A.ID_Carrera  = C.Id_Carrera INNER JOIN usuarios u ON u.correo = A.correo INNER JOIN
empresas em ON A.ID_Empresa  = em.ID_Empresa INNER JOIN facultades F ON C.ID_Facultades = F.IDFacultates
 WHERE ID_Alumno  = '" . $id . "'";

$query1 = $dbh->query($sql1);


try {
    $data = array_merge($query1->fetchAll(PDO::FETCH_ASSOC));
    // enviar info
    echo json_encode(array("alumno" => $data));
} catch (\Throwable $th) {
    echo ($th);
}
