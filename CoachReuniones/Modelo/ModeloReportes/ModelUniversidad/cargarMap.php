<?php
include "../../../../BaseDatos/conexion.php";

// arrays con las listas de ciclos,clases, financiamiento y sedes

$ciclos = $_POST['ciclos'];
$clases = $_POST['clases'];
$financiamientos = $_POST['financiamientos'];
$sedes = $_POST['sedes'];
$status = $_POST['status'];

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

if (count($status) >= 1) {
    for ($i = 0; $i < count($status); $i++) {
        $fragmento5[] = "'$status[$i]'";
    }
    $listaStatus = implode(",", $fragmento5);
}

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



// consultas san salvador

// consulta para seleccionar la cantidad de materias aprobadas en san salvador
$consulta1 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Aprobada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Aprobada' AND ($fragmento1) AND a.ID_Sede = 'SSFT' AND ($fragmento3) AND ($fragmento4)  AND (a.StatusActual IN ($listaStatus)) ";

// consulta para seleccionar la cantidad de materias reprobadas en san salvador
$consulta2 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Reprobada' AND ($fragmento1) AND a.ID_Sede = 'SSFT' AND ($fragmento3) AND ($fragmento4)  AND (a.StatusActual IN ($listaStatus))";

// consulta para seleccionar la cantidad de materias retiradas en san salvador
$consulta3 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Retirada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Retirada' AND ($fragmento1) AND a.ID_Sede = 'SSFT' AND ($fragmento3) AND ($fragmento4)  AND (a.StatusActual IN ($listaStatus))";



// consultas santa ana
// consulta para seleccionar la cantidad de materias aprobadas en santa ana
$consulta4 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Aprobada' AND ($fragmento1) AND a.ID_Sede = 'SAFT' AND ($fragmento3) AND ($fragmento4)  AND (a.StatusActual IN ($listaStatus)) ";

// consulta para seleccionar la cantidad de materias reprobadas en santa ana
$consulta5 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Reprobada' AND ($fragmento1) AND a.ID_Sede = 'SAFT' AND ($fragmento3) AND ($fragmento4)  AND (a.StatusActual IN ($listaStatus))";

// consulta para seleccionar la cantidad de materias retiradas en santa ana
$consulta6 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Retirada' AND ($fragmento1) AND a.ID_Sede = 'SAFT' AND ($fragmento3) AND ($fragmento4)  AND (a.StatusActual IN ($listaStatus))";



// consultas por genero masculino

// consulta para seleccionar la cantidad de materias aprobadas en san salvador
$consulta7 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Aprobada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Aprobada' AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4) AND a.Sexo = 'M'  AND (a.StatusActual IN ($listaStatus))";

// consulta para seleccionar la cantidad de materias reprobadas en san salvador
$consulta8 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Reprobada' AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4) AND a.Sexo = 'M' AND (a.StatusActual IN ($listaStatus)) ";

// consulta para seleccionar la cantidad de materias Retirada en san salvador
$consulta9 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Retirada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Retirada' AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4) AND a.Sexo = 'M' AND (a.StatusActual IN ($listaStatus)) ";

// consultas por genero femenino

// consulta para seleccionar la cantidad de materias aprobadas en san salvador
$consulta10 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Aprobada' AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4) AND a.Sexo = 'F'  AND (a.StatusActual IN ($listaStatus))";

// consulta para seleccionar la cantidad de materias reprobadas en san salvador
$consulta11 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Reprobada' AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4) AND a.Sexo = 'F' AND (a.StatusActual IN ($listaStatus))  ";

// consulta para seleccionar la cantidad de materias reprobadas en san salvador
$consulta12 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Retirada' AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4) AND a.Sexo = 'F' AND (a.StatusActual IN ($listaStatus)) ";

// CONSULTAS GENERALES


$consulta13 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Aprobada' AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4)  AND (a.StatusActual IN ($listaStatus)) ";

// consulta para seleccionar la cantidad de materias reprobadas en san salvador
$consulta14 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Reprobada' AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4) AND (a.StatusActual IN ($listaStatus)) ";

// consulta para seleccionar la cantidad de materias reprobadas en san salvador
$consulta15 = "SELECT COUNT(IM.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria IM
INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU 
= IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
WHERE IM.estado = 'Retirada' AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4)  AND (a.StatusActual IN ($listaStatus))";

$consulta16 = "SELECT DISTINCT (SUM(e.cum))/COUNT(e.cum) AS cum FROM inscripcionmateria IM INNER JOIN 
inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e
ON e.idExpedienteU  = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno WHERE 
($fragmento1) AND a.ID_Sede = 'SSFT' AND ($fragmento3) AND ($fragmento4) AND (a.StatusActual IN ($listaStatus)) ";

$consulta17 = "SELECT DISTINCT (SUM(e.cum))/COUNT(e.cum) AS cum FROM inscripcionmateria IM INNER JOIN 
inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e
ON e.idExpedienteU  = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno WHERE 
($fragmento1) AND a.ID_Sede = 'SAFT' AND ($fragmento3) AND ($fragmento4) AND (a.StatusActual IN ($listaStatus))";

$consulta18 = "SELECT DISTINCT (SUM(e.cum))/COUNT(e.cum) AS cum FROM inscripcionmateria IM INNER JOIN 
inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e
ON e.idExpedienteU  = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno WHERE 
($fragmento1) AND a.Sexo = 'M' AND ($fragmento3) AND ($fragmento4) AND (a.StatusActual IN ($listaStatus)) ";

$consulta19 = "SELECT DISTINCT (SUM(e.cum))/COUNT(e.cum) AS cum FROM inscripcionmateria IM INNER JOIN 
inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e
ON e.idExpedienteU  = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno WHERE 
($fragmento1) AND a.Sexo = 'F' AND ($fragmento3) AND ($fragmento4) AND (a.StatusActual IN ($listaStatus)) ";


// ejecutamos para obtener el total de materias aprobadas, reprobadas, retiradas en san salvador
$stmt = $pdo->prepare($consulta1);
$stmt->execute();
$result1 = $stmt->fetch();

$stmt2 = $pdo->prepare($consulta2);
$stmt2->execute();
$result2 = $stmt2->fetch();

$stmt3 = $pdo->prepare($consulta3);
$stmt3->execute();
$result3 = $stmt3->fetch();

// ejecutamos para obtener el total de materias aprobadas, reprobadas, retiradas en santa ana
$stmt4 = $pdo->prepare($consulta4);
$stmt4->execute();
$result4 = $stmt4->fetch();

$stmt5 = $pdo->prepare($consulta5);
$stmt5->execute();
$result5 = $stmt5->fetch();

$stmt6 = $pdo->prepare($consulta6);
$stmt6->execute();
$result6 = $stmt6->fetch();


// ejecutamos para obtener el total de materias cuando el genero sea masculino
$stmt7 = $pdo->prepare($consulta7);
$stmt7->execute();
$result7 = $stmt7->fetch();

$stmt8 = $pdo->prepare($consulta8);
$stmt8->execute();
$result8 = $stmt8->fetch();

$stmt9 = $pdo->prepare($consulta9);
$stmt9->execute();
$result9 = $stmt9->fetch();


// ejecutamos para obtener el total de materias cuando el genero sea femenino
$stmt10 = $pdo->prepare($consulta10);
$stmt10->execute();
$result10 = $stmt10->fetch();

$stmt11 = $pdo->prepare($consulta11);
$stmt11->execute();
$result11 = $stmt11->fetch();

$stmt12 = $pdo->prepare($consulta12);
$stmt12->execute();
$result12 = $stmt12->fetch();


// EJECUTASMOS CONSULTAS GENERALES
$stmt13 = $pdo->prepare($consulta13);
$stmt13->execute();
$result13 = $stmt13->fetch();

$stmt14 = $pdo->prepare($consulta14);
$stmt14->execute();
$result14 = $stmt14->fetch();

$stmt15 = $pdo->prepare($consulta15);
$stmt15->execute();
$result15 = $stmt15->fetch();

//Ejecución de consultas de Cums
$stmt16 = $pdo->prepare($consulta16);
$stmt16->execute();
$result16 = $stmt16->fetch();

$stmt17 = $pdo->prepare($consulta17);
$stmt17->execute();
$result17 = $stmt17->fetch();

$stmt18 = $pdo->prepare($consulta18);
$stmt18->execute();
$result18 = $stmt18->fetch();

$stmt19 = $pdo->prepare($consulta19);
$stmt19->execute();
$result19 = $stmt19->fetch();

// devolver datos como json
$respuestaValidacion = array();
// graficas san salvador
$respuestaValidacion["result1"] = $result1[0];
$respuestaValidacion["result2"] = $result2[0];
$respuestaValidacion["result3"] = $result3[0];
// graficas santa ana
$respuestaValidacion["result4"] = $result4[0];
$respuestaValidacion["result5"] = $result5[0];
$respuestaValidacion["result6"] = $result6[0];
// graficas por sexo Masculino
$respuestaValidacion["result7"] = $result7[0];
$respuestaValidacion["result8"] = $result8[0];
$respuestaValidacion["result9"] = $result9[0];
// graficas por sexo femenino
$respuestaValidacion["result10"] = $result10[0];
$respuestaValidacion["result11"] = $result11[0];
$respuestaValidacion["result12"] = $result12[0];
// consultas generales
$respuestaValidacion["result13"] = $result13[0];
$respuestaValidacion["result14"] = $result14[0];
$respuestaValidacion["result15"] = $result15[0];


// listas de dato ingresados(ciclos,clases,financiamientos, sedes)

$respuestaValidacion["ciclos"] = $ciclos;
$respuestaValidacion["clases"] = $clases;
$respuestaValidacion["financiamientos"] = $financiamientos;
$respuestaValidacion["sedes"] = $sedes;

// conteo de datos ingresados
$respuestaValidacion["cantidadCiclos"] = $contarCiclos;
$respuestaValidacion["cantidadClases"] = $contarClases;
$respuestaValidacion["cantidadFinanciamientos"] = $contarfinanciamientos;
$respuestaValidacion["cantidadSedes"] = $contarSedes;


// resultado consultas 

$respuestaValidacion["fragmento1"] = $consulta1;

//agregamos los resultados de cum al vector
$respuestaValidacion["cumSSFT"] = $result16[0];
$respuestaValidacion["cumSAFT"] = $result17[0];
$respuestaValidacion["cumM"] = $result18[0];
$respuestaValidacion["cumF"] = $result19[0];

/*ahora lo imprimes 
IMPORTANTE !! IMPORTANTE !! IMPORTANTE !! IMPORTANTE !! 
No imprimas otra cosa más que la respuesta */

//Convertimos el array a JSON y lo imprimimos para que pueda recuperarlo el JS
$respuesta = json_encode($respuestaValidacion);
echo $respuesta;
