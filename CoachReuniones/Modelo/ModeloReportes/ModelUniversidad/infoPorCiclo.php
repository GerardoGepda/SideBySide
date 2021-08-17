<?php
// incluir conexion
include "../../../../BaseDatos/conexion.php";

// ocultar errores
//error_reporting(0);

// declaracion de variables
$json = array("general" => array(), "retiradas" => array(), "reprobadas" => array());
$json2 = array();
$contador = 0;

//recibimos los datos
$ciclos = $_POST['ciclos'];
$idsAlumnos = $_POST['idalumnos'];

$alumnos = implode(",", $idsAlumnos);
//echo $alumnos;
 
try {
    $sqlls = "SELECT al.ID_Alumno, al.Nombre, al.correo, e.Nombre as universidad, al.Class, al.StatusActual, al.FuenteFinacimiento FROM alumnos al
    INNER JOIN expedienteu eu
    ON al.ID_Alumno = eu.ID_Alumno INNER JOIN empresas e on e.ID_Empresa = al.ID_Empresa 
    WHERE al.ID_Alumno IN  ($alumnos)";

    $queryls = $pdo->prepare($sqlls);
    $queryls->execute();

} catch (PDOException $expt) {
    echo "ERROR: " .$expt->getMessage();
}

$cantidadAlm = $queryls->rowCount();
if ($cantidadAlm > 0) {
    array_push($json["general"], $queryls->fetchAll(PDO::FETCH_NUM));
}

foreach ($ciclos as $key => $value) { 

    try {
        //promedio de notas del ciclo
        $sql1 = "SELECT al.ID_Alumno, ROUND((SUM(nota)/COUNT(al.ID_Alumno)),2) as promedio FROM inscripcionmateria im INNER JOIN inscripcionciclos ic
        ON ic.Id_InscripcionC = im.Id_InscripcionC
        INNER JOIN expedienteu eu
        ON eu.idExpedienteU = ic.idExpedienteU
        INNER JOIN alumnos al
        ON al.ID_Alumno = eu.ID_Alumno
        WHERE ic.cicloU = '$value' AND al.ID_Alumno IN ($alumnos) AND im.estado IN ('Aprobada', 'Reprobada') GROUP BY al.ID_Alumno";

        $query1 = $pdo->prepare($sql1);
        $query1->execute();

        //materias retiradas de cada alumno
        $sql2 = "SELECT al.ID_Alumno, al.Nombre, al.correo, e.Nombre as universidad, al.Class, al.StatusActual, al.FuenteFinacimiento, im.estado, ic.cicloU, GROUP_CONCAT(ma.nombreMateria SEPARATOR ', ') AS materias, COUNT(ma.nombreMateria) AS cantidad
        FROM inscripcionmateria im 
        INNER JOIN inscripcionciclos ic
        ON ic.Id_InscripcionC = im.Id_InscripcionC
        INNER JOIN expedienteu eu
        ON eu.idExpedienteU = ic.idExpedienteU
        INNER JOIN alumnos al
        ON al.ID_Alumno = eu.ID_Alumno
        INNER JOIN materias ma
        ON ma.idMateria = im.idMateria
        INNER JOIN empresas e on e.ID_Empresa = al.ID_Empresa
        WHERE im.estado = 'Retirada' AND ic.cicloU = '$value' AND al.ID_Alumno IN ($alumnos) 
        GROUP BY al.ID_Alumno";

        $query2 = $pdo->prepare($sql2);
        $query2->execute();

        //materias reprobadas de cada alumno
        $sql3 = "SELECT al.ID_Alumno, al.Nombre, al.correo,e.Nombre as universidad, al.Class, al.StatusActual, al.FuenteFinacimiento, im.estado, ic.cicloU, GROUP_CONCAT(ma.nombreMateria SEPARATOR ', ') AS materias, COUNT(ma.nombreMateria) AS cantidad
        FROM inscripcionmateria im 
        INNER JOIN inscripcionciclos ic
        ON ic.Id_InscripcionC = im.Id_InscripcionC
        INNER JOIN expedienteu eu
        ON eu.idExpedienteU = ic.idExpedienteU
        INNER JOIN alumnos al
        ON al.ID_Alumno = eu.ID_Alumno
        INNER JOIN materias ma
        ON ma.idMateria = im.idMateria
        INNER JOIN empresas e on e.ID_Empresa = al.ID_Empresa
        WHERE im.estado = 'Reprobada' AND ic.cicloU = '$value' AND al.ID_Alumno IN ($alumnos) 
        GROUP BY al.ID_Alumno";

        $query3 = $pdo->prepare($sql3);
        $query3->execute();

    } catch (PDOException $err) {
        echo "ERROR: " .$err->getMessage();
    }

    $cantidad = $query1->rowCount();
    if ($cantidad > 0) {
        array_push($json["general"], $query1->fetchAll(PDO::FETCH_NUM));
    }else {
        //echo "sin datos general ($value)";
        array_push($json["general"], array());
    }

    $cantidadReti = $query2->rowCount();
    if ($cantidadReti > 0) {
        $json["retiradas"] = array_merge($json["retiradas"], $query2->fetchAll(PDO::FETCH_NUM));
    } else {
        //echo "sin datos retiradas ($value)";
    }

    $cantidadRepro = $query3->rowCount();
    if ($cantidadRepro > 0) {
        $json["reprobadas"] = array_merge($json["reprobadas"], $query3->fetchAll(PDO::FETCH_NUM));
    } else {
        //echo "sin datos reprobadas ($value)";
    }
}

$jsondata = json_encode($json);
echo $jsondata;