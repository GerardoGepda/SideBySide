<?php
// incluir conexion
include "../../../../BaseDatos/conexion.php";
// ocultar errores
error_reporting(0);

// declaracion de variables
$json = array();
$json2 = array();
$contador = 0;


// extracion de datos
// arrays con las listas de ciclos,clases, financiamiento y sedes

$ciclos = $_POST['ciclos'];
$clases = $_POST['clases'];
$financiamientos = $_POST['financiamientos'];
$sedes = $_POST['sedes'];

// fin de extracción de datos

// contar cantidad de datos
$contarCiclos = count($ciclos);
$contarClases = count($clases);
$contarfinanciamientos = count($financiamientos);
$contarSedes = count($sedes);

// declaracion de fragmentos
$fragmento1 = "";
$fragmento2 = "";
$fragmento3 = "";
$fragmento4 = "";

// recorrer la cantidad de condiciones que se necesitan a partir del conteo de la condicion

// condicion para ciclos
if ($contarCiclos >= 1) {
    for ($i = 0; $i < $contarCiclos; $i++) {
        $conditions1[]   = "IC.cicloU = '$ciclos[$i]' OR ";
    }
    $var1 = implode(" ", $conditions1);
    $fragmento1 = substr($var1, 0, -3);
} else {
    $conditions1 = " ";
}
// **********************************
// condicion para sede

if ($contarSedes >= 1) {
    for ($i = 0; $i < $contarSedes; $i++) {
        $conditions2[]   = "a.ID_Sede = '$sedes[$i]' OR ";
    }
    $var2 = implode(" ", $conditions2);
    $fragmento2 = substr($var2, 0, -3);
} else {
    $conditions2 = " ";
}
// ********************************

// condicion para clases
if ($contarClases >= 1) {
    for ($i = 0; $i < $contarClases; $i++) {
        $conditions3[]   = "a.Class = $clases[$i] OR ";
    }
    $var3 = implode(" ", $conditions3);
    $fragmento3 = substr($var3, 0, -3);
} else {
    $conditions3 = " ";
}
// **********************************
// condicion para financiamiento
if ($contarfinanciamientos >= 1) {
    for ($i = 0; $i < $contarfinanciamientos; $i++) {
        $conditions4[]   = "a.FuenteFinacimiento = '$financiamientos[$i]' OR ";
    }
    $var4 = implode(" ", $conditions4);
    $fragmento4 = substr($var4, 0, -3);
} else {
    $conditions4 = " ";
}

// consultas
$sql = "SELECT * FROM empresas WHERE Tipo = 'Universidad' ";

// ejecucion de consultas
$query = $pdo->prepare($sql);
$query->execute();
$cantidad = $query->rowCount();

// recorrer consultas
while ($row = $query->fetch()) {
    $univeridades = $row['ID_Empresa'];
    // consultas para obtener el total de materias aprobadas, reprobadas y retiradas por universidad

    $sql2 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM INNER JOIN 
inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e
ON e.idExpedienteU  = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno WHERE 
IM.estado = 'Aprobada' AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4)
AND a.ID_Empresa  = '$univeridades' ";

    $sql3 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM INNER JOIN 
inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e
ON e.idExpedienteU  = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno WHERE 
IM.estado = 'Reprobada' AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4)
AND a.ID_Empresa  = '$univeridades' ";

    $sql4 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM INNER JOIN 
inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e
ON e.idExpedienteU  = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno WHERE 
IM.estado = 'Retirada' AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4)
AND a.ID_Empresa  = '$univeridades' ";


    $sql5 = "SELECT e.cum AS cum FROM inscripcionmateria IM INNER JOIN 
inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e
ON e.idExpedienteU  = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno WHERE 
($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4)
AND a.ID_Empresa  = '$univeridades' ";



    // extraer datos por universidad (nombre, nota, estado y materia)

    $sql9 = "SELECT  m.nombreMateria, a.Nombre, IM.nota, IM.estado,  a.ID_Empresa   FROM inscripcionmateria
     IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e
ON e.idExpedienteU  = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno INNER JOIN
materias m on m.idExpedienteU = e.idExpedienteU WHERE ($fragmento1) AND 
($fragmento2)  AND ($fragmento3) AND ($fragmento4) AND a.ID_Empresa  = '$univeridades' ";


    // MATERIAS APROBADAS
    $stmt = $pdo->prepare($sql2);
    $stmt->execute();
    $result = $stmt->fetch();
    // MATERIAS REPROBADAS
    $stmt2 = $pdo->prepare($sql3);
    $stmt2->execute();
    $result2 = $stmt2->fetch();
    // MATERIAS RETIRADAS
    $stmt3 = $pdo->prepare($sql4);
    $stmt3->execute();
    $result3 = $stmt3->fetch();



    // OBTENER CUM
    $stmt4 = $pdo->prepare($sql5);
    $stmt4->execute();
    $result4 = $stmt4->fetch();

    $stmt8 = $pdo->prepare($sql9);
    $stmt8->execute();
    $result8 = $stmt8->fetch();

    $contador++;
    if ($result[0] == "0" && $result2[0] == "0" && $result3[0] == "0") {
        continue;
    }
    

    $json[] = array(
        "id" => $row['ID_Empresa'],
        "name" => ($row['Nombre']),
        "aprobadas" => $result[0],
        "reprobadas" => $result2[0],
        "retiradas" => $result3[0],
        "cum" => $result4['cum'],
        "student" => $result8
    );
}

$jsondata = json_encode($json);

echo $jsondata;
