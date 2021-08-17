<?php

include_once "../../../Conexion/conexion.php";
session_start();

$FotoAlumno = '';
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
$data = array();
$cantidad = array();
try {
    // extraer información
    $clase = $input['clase'];
    $ciclos = $input['ciclos'];
    $estado = $input['estado'];

    if ($clase != "Class" && $ciclos != "Ciclo" &&  $estado != "Status") {
        // consulta para obtener la lista de los alumnos que no han subido las notas
        $stmt = "SELECT alumnos.ID_Alumno, alumnos.Nombre as 'name', Class, correo, carrera.nombre, alumnos.ID_Sede, 
        alumnos.ID_Empresa FROM alumnos  JOIN carrera ON carrera.Id_Carrera = alumnos.ID_Carrera JOIN expedienteu ON
        expedienteu.ID_Alumno = alumnos.ID_Alumno  WHERE expedienteu.idExpedienteU 
        NOT IN( SELECT i.idExpedienteU FROM inscripcionciclos i LEFT JOIN expedienteu e ON  e.idExpedienteU 
        = i.idExpedienteU  WHERE i.cicloU = '$ciclos') AND alumnos.StatusActual = '$estado'   AND alumnos.Class = $clase AND alumnos.StatusActual = '$estado'
        ORDER BY name asc";

        // cantidad de alumnos de la class seleccionada
        $stmt2 = "SELECT COUNT(a.ID_Alumno) FROM alumnos a INNER JOIN expedienteu e 
        on e.ID_Alumno = a.ID_Alumno WHERE a.Class = $clase AND a.StatusActual = '$estado'";

        //inicio de ejecutar consultas
        $query1 = $dbh->query($stmt);
        $data = array_merge($query1->fetchAll(PDO::FETCH_ASSOC));

        $query2 = $dbh->query($stmt2);
        $cantidad = $query2->fetchAll(PDO::FETCH_NUM);
        // fin de ejecutar consultas

        // enviar info
        echo json_encode(array("clase" => $clase, "ciclos" => $ciclos, "status" => $estado, "lista" => $data, "cantidad" => $cantidad[0]));
    } else {
        echo json_encode(array("Error" => "let try again!!"));
    }
} catch (\Throwable $th) {
    echo json_encode(array("error" => $th));
}
