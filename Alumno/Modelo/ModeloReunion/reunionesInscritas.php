<?php
include_once "../../../BaseDatos/conexion.php";
session_start();

$_SESSION['Email'];

$stmt1 = $pdo->prepare("SELECT * FROM `alumnos` WHERE correo='" . $_SESSION['Email'] . "'");
// Ejecutamos
$stmt1->execute();

while ($fila = $stmt1->fetch()) {
    $name = $fila["Nombre"];
    $id = $fila["ID_Alumno"];
}



$data = array();
$sede = $_SESSION['Lugar'];


$stmt1 = $pdo->prepare("SELECT r.ID_Reunion as id , r.Titulo as title , r.Fecha as start, r.Fecha as end FROM reuniones r INNER JOIN inscripcionreunion i
ON  i.id_reunion  = r.ID_Reunion  WHERE r.Estado ='Activo'  AND ID_Sede = ? AND  i.id_alumno = ? ");
// Ejecutamos
$stmt1->execute(array($sede, $id));

$stmt2 = $pdo->prepare("SELECT r.ID_Reunion as id , r.Titulo as title , r.Fecha as start, r.Fecha as end  FROM reuniones r INNER JOIN inscripcionreunion i
ON  i.id_reunion  = r.ID_Reunion  WHERE r.Estado = 'Finalizado' AND r.ID_Sede = ? AND  i.id_alumno = ?  ");
// Ejecutamos
$stmt2->execute(array($sede, $id));


$eventsAct = $stmt1->fetchAll();

$eventsFin = $stmt2->fetchAll();

echo json_encode(array(
    "reuniones" => $eventsAct,
    "reunionesFinaizadas" => $eventsFin
));
