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
    $sedes = $input['sedes'];

    if ($clase != "Class" && $ciclos != "Ciclo" &&  $estado != "Status") {
        // consulta para obtener la lista de los alumnos que no han subido las notas
        $stmt = "
        (
            SELECT COUNT(a.ID_Alumno) AS 'NotasFalt', ic.pdfnotas, a.Nombre, a.Class, a.ID_Sede AS 'Sede' , c.nombre AS 'Carrera' , a.correo, a.ID_Empresa AS 'Universidad'
            FROM inscripcionmateria im 
            INNER JOIN inscripcionciclos ic ON ic.Id_InscripcionC = im.Id_InscripcionC 
            INNER JOIN expedienteu eu ON eu.idExpedienteU = ic.idExpedienteU 
            INNER JOIN alumnos a ON a.ID_Alumno = eu.ID_Alumno 
            INNER JOIN carrera c ON c.Id_Carrera = a.ID_Carrera
            WHERE ic.cicloU IN ($ciclos) AND a.Class IN ($clase) AND a.StatusActual IN ($estado) AND a.ID_Sede IN ($sedes) AND 
            (im.estado <> 'Aprobada' AND im.estado <> 'Retirada' AND im.estado <> 'Reprobada') 
            GROUP BY a.ID_Alumno
        )
        UNION
        (
            SELECT '0' AS 'NotasFalt', ic.pdfnotas, a.Nombre, a.Class, a.ID_Sede AS 'Sede', c.nombre AS 'Carrera' , a.correo, a.ID_Empresa AS 'Universidad' 
            FROM inscripcionmateria im 
            INNER JOIN inscripcionciclos ic ON ic.Id_InscripcionC = im.Id_InscripcionC 
            INNER JOIN expedienteu eu ON eu.idExpedienteU = ic.idExpedienteU 
            INNER JOIN alumnos a ON a.ID_Alumno = eu.ID_Alumno 
            INNER JOIN carrera c ON c.Id_Carrera = a.ID_Carrera
            WHERE ic.cicloU IN ($ciclos) AND a.Class IN ($clase)  AND a.StatusActual IN ($estado) AND a.ID_Sede IN ($sedes) AND 
            (ic.pdfnotas IS NULL AND (im.estado = 'Aprobada' OR im.estado = 'Retirada' OR im.estado = 'Reprobada')) 
            GROUP BY a.ID_Alumno
        )";

        // cantidad de alumnos de la class seleccionada
        $stmt2 = "SELECT COUNT(a.ID_Alumno) FROM inscripcionmateria im 
            INNER JOIN inscripcionciclos ic ON ic.Id_InscripcionC = im.Id_InscripcionC 
            INNER JOIN expedienteu eu ON eu.idExpedienteU = ic.idExpedienteU 
            INNER JOIN alumnos a ON a.ID_Alumno = eu.ID_Alumno 
            INNER JOIN carrera c ON c.Id_Carrera = a.ID_Carrera
            WHERE ic.cicloU IN ($ciclos) AND a.Class IN ($clase)  AND a.StatusActual IN ($estado) AND a.ID_Sede IN ($sedes) AND 
            (ic.pdfnotas IS NOT NULL AND (im.estado = 'Aprobada' OR im.estado = 'Retirada' OR im.estado = 'Reprobada')) 
        GROUP BY a.ID_Alumno";

        //inicio de ejecutar consultas
        $query1 = $dbh->query($stmt);
        $data = array_merge($query1->fetchAll(PDO::FETCH_ASSOC));
        $cantFaltantes = count($data);

        $query2 = $dbh->query($stmt2);
        $cantidadCmplt = $query2->fetchAll(PDO::FETCH_NUM);
        $cantCompletas = count($cantidadCmplt);
        // fin de ejecutar consultas

        // enviar info
        echo json_encode(array("status" => $estado, "clase" => $clase,"ciclos" => $ciclos, "lista" => $data, "completos" => $cantCompletas, "faltantes" => $cantFaltantes));
    } else {
        echo json_encode(array("Error" => "let try again!!"));
    }
} catch (\Throwable $th) {
    echo json_encode(array("error" => $th));
}
