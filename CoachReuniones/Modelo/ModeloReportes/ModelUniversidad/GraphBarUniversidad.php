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


    $sql5 = "SELECT DISTINCT (SUM(e.cum))/COUNT(e.cum) AS cum FROM inscripcionmateria IM INNER JOIN 
    inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER JOIN expedienteu e
    ON e.idExpedienteU  = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno WHERE 
($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4) ";


    $sql15 = "SELECT (SUM(e.cum))/COUNT(e.cum) AS cum
    FROM inscripcionmateria IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER
     JOIN expedienteu e ON e.idExpedienteU = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
     JOIN materias m ON m.idMateria = IM.idMateria INNER JOIN usuarios u ON u.correo = a.correo  WHERE (IM.estado = 'Aprobada') AND ($fragmento1) AND 
     ($fragmento2)  AND ($fragmento3) AND ($fragmento4) AND a.ID_Empresa  = '$univeridades'";


    // extraer datos por universidad (nombre, nota, estado y materia)
    // SELECT  ,IM.idMateria  IM.nota, IM.estado

    $sql9 = "SELECT a.Nombre as alumno, IM.idMateria as id, IM.nota as nota, IM.estado as estado, m.nombreMateria
 as  nombreMateria , u.imagen as imagen , a.StatusActual as estatus, a.FuenteFinacimiento as Financiamiento, a.Class as Class, a.correo as Correo, e.avancePensum as Avance, a.ID_alumno as idAlumno
 FROM inscripcionmateria IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER
  JOIN expedienteu e ON e.idExpedienteU = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
  JOIN materias m ON m.idMateria = IM.idMateria INNER JOIN usuarios u ON u.correo = a.correo  WHERE (IM.estado = 'Aprobada') AND ($fragmento1) AND 
  ($fragmento2)  AND ($fragmento3) AND ($fragmento4) AND a.ID_Empresa  = '$univeridades' ";

    $sql10 = "SELECT a.Nombre as alumno, IM.idMateria as id, IM.nota as nota, IM.estado as estado, m.nombreMateria
 as  nombreMateria , u.imagen as imagen, a.StatusActual as estatus, a.FuenteFinacimiento as Financiamiento, a.Class as Class, a.correo as Correo, e.avancePensum as Avance, a.ID_alumno as idAlumno
FROM inscripcionmateria IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER
 JOIN expedienteu e ON e.idExpedienteU = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
 JOIN materias m ON m.idMateria = IM.idMateria INNER JOIN usuarios u ON u.correo = a.correo WHERE (IM.estado = 'Reprobada') AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4) AND a.ID_Empresa  = '$univeridades' ";

    $sql11 = "SELECT a.Nombre as alumno, IM.idMateria as id, IM.nota as nota, IM.estado as estado, m.nombreMateria
as  nombreMateria , u.imagen as imagen, a.StatusActual as estatus, a.FuenteFinacimiento as Financiamiento, a.Class as Class, a.correo as Correo, e.avancePensum as Avance, a.ID_alumno as idAlumno
FROM inscripcionmateria IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC INNER
 JOIN expedienteu e ON e.idExpedienteU = IC.idExpedienteU INNER JOIN alumnos a ON a.ID_Alumno = e.ID_Alumno 
 JOIN materias m ON m.idMateria = IM.idMateria INNER JOIN usuarios u ON u.correo = a.correo WHERE (IM.estado = 'Retirada') AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND ($fragmento4) AND a.ID_Empresa  = '$univeridades' ";

    // seleccionar solo nombres
    //  count(IM.idMateria) as total, (SUM(IM.nota)/COUNT(IM.nota) as promedio,
    $sql12 = "SELECT DISTINCT a.Nombre as alumno,  u.imagen as imagen, COUNT(IM.idMateria) as total, TRUNCATE((SUM(IM.nota)/COUNT(IM.idMateria)),2)  as promedio
    , a.correo as correo,  a.StatusActual as estatus, a.FuenteFinacimiento as Financiamiento, a.Class as Class , a.ID_Empresa as empresa   FROM inscripcionmateria IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC
    = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU = IC.idExpedienteU INNER JOIN alumnos a ON
    a.ID_Alumno = e.ID_Alumno  JOIN materias m ON m.idMateria = IM.idMateria INNER JOIN usuarios u ON u.correo =
    a.correo  WHERE (IM.estado = 'Aprobada') AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND 
    ($fragmento4) AND a.ID_Empresa  = '$univeridades' GROUP BY a.Nombre ";

    // count(IM.idMateria) as total, (SUM(IM.nota)/COUNT(IM.nota) as promedio, 
    $sql13 = "SELECT DISTINCT a.Nombre as alumno,  u.imagen as imagen, COUNT(IM.idMateria) as total, TRUNCATE((SUM(IM.nota)/COUNT(IM.idMateria)),2)  as promedio
    , a.correo as correo,  a.StatusActual as estatus, a.FuenteFinacimiento as Financiamiento, a.Class as Class  FROM inscripcionmateria IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC
    = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU = IC.idExpedienteU INNER JOIN alumnos a ON
    a.ID_Alumno = e.ID_Alumno  JOIN materias m ON m.idMateria = IM.idMateria INNER JOIN usuarios u ON u.correo =
    a.correo  WHERE (IM.estado = 'Reprobada') AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND
     ($fragmento4) AND a.ID_Empresa  = '$univeridades' GROUP BY a.Nombre ";
    // count(IM.idMateria) as total, (SUM(IM.nota)/COUNT(IM.nota) as promedio, 

    $sql14 = "SELECT DISTINCT a.Nombre as alumno,  u.imagen as imagen, COUNT(IM.idMateria) as total, TRUNCATE((SUM(IM.nota)/COUNT(IM.idMateria)),2)  as promedio
    , a.correo as correo,  a.StatusActual as estatus, a.FuenteFinacimiento as Financiamiento, a.Class as Class  FROM inscripcionmateria IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC
    = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU = IC.idExpedienteU INNER JOIN alumnos a ON
    a.ID_Alumno = e.ID_Alumno  JOIN materias m ON m.idMateria = IM.idMateria INNER JOIN usuarios u ON u.correo =
    a.correo  WHERE (IM.estado = 'Retirada') AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND 
    ($fragmento4) AND a.ID_Empresa  = '$univeridades' GROUP BY a.Nombre ";



    //INICIO  DE OBTENER CANTIDAD DE ALUMNOS QUE HAN APROBADO MATERIAS

    $sql16 = "SELECT COUNT(DISTINCT a.Nombre) as alumno FROM inscripcionmateria IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC
    = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU = IC.idExpedienteU INNER JOIN alumnos a ON
    a.ID_Alumno = e.ID_Alumno  JOIN materias m ON m.idMateria = IM.idMateria  WHERE (IM.estado = 'Aprobada') AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND 
    ($fragmento4) AND a.ID_Empresa  = '$univeridades'";

    $sql17 = "SELECT COUNT(DISTINCT a.Nombre) as alumno FROM inscripcionmateria IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC
    = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU = IC.idExpedienteU INNER JOIN alumnos a ON
    a.ID_Alumno = e.ID_Alumno  JOIN materias m ON m.idMateria = IM.idMateria   WHERE (IM.estado = 'Reprobada') AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND 
    ($fragmento4) AND a.ID_Empresa  = '$univeridades'" ;

    $sql18 = "SELECT COUNT(DISTINCT a.Nombre) as alumno FROM inscripcionmateria IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC
    = IC.Id_InscripcionC INNER JOIN expedienteu e ON e.idExpedienteU = IC.idExpedienteU INNER JOIN alumnos a ON
    a.ID_Alumno = e.ID_Alumno  JOIN materias m ON m.idMateria = IM.idMateria  WHERE (IM.estado = 'Retirada') AND ($fragmento1) AND ($fragmento2)  AND ($fragmento3) AND 
    ($fragmento4) AND a.ID_Empresa  = '$univeridades' ";

    // FIN DE OBTENER CANTIDAD DE ALUMNOS QUE HAN APROBADO MATERIAS


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


    // INICIO DE CUM POR UNIVERSIDAD

    $stmt188 = $pdo->prepare($sql15);
    $stmt188->execute();
    $globalInfo = $stmt188->fetchAll();

    // FIM DE CUM POR UNIVERSIDAD

    // OBTENER CUM
    $stmt4 = $pdo->prepare($sql5);
    $stmt4->execute();
    $result4 = $stmt4->fetch();

    $stmt8 = $pdo->prepare($sql9);
    $stmt8->execute();
    $result8 = $stmt8->fetchAll();

    $stmt9 = $pdo->prepare($sql10);
    $stmt9->execute();
    $result9 = $stmt9->fetchAll();

    $stmt10 = $pdo->prepare($sql11);
    $stmt10->execute();
    $result10 = $stmt10->fetchAll();


    // INICIO DE obtener lista alumnos

    $stmt11 = $pdo->prepare($sql12);
    $stmt11->execute();
    $result11 = $stmt11->fetchAll();

    $stmt12 = $pdo->prepare($sql13);
    $stmt12->execute();
    $result12 = $stmt12->fetchAll();

    $stmt13 = $pdo->prepare($sql14);
    $stmt13->execute();
    $result13 = $stmt13->fetchAll();

    //FIN  DE obtener lista alumnos

    //INICIO DE GRAFICAS POR ALUMNO
    $stmt1888 = $pdo->prepare($sql16);
    $stmt1888->execute();
    $alumnosAprobados = $stmt1888->fetchAll();

    $stmt1889 = $pdo->prepare($sql17);
    $stmt1889->execute();
    $alumnosReprobados = $stmt1889->fetchAll();

    $stmt18810 = $pdo->prepare($sql18);
    $stmt18810->execute();
    $alumnosRetirados = $stmt18810->fetchAll();

    // FIN DE GRAFICAS POR ALUMNO

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
        "listaAprobado" => $result8,
        "listaReprobado" => $result9,
        "listaRetirado" => $result10,
        "l1" => $result11,
        "l2" => $result12,
        "l3" => $result13,
        "globalInfo" => $globalInfo[0],
        "alumnosAprobados" => $alumnosAprobados[0],
        "alumnosReprobados" => $alumnosReprobados[0],
        "alumnosRetirados" => $alumnosRetirados[0]
    );
}

$jsondata = json_encode($json);

echo $jsondata;
