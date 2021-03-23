<?php
// incluir conexion
include "../../../../BaseDatos/conexion.php";
// ocultar errores
error_reporting(0);

// declaracion de variables
$json = array();
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

    $json[] = array(
        "name" => $row['Nombre'],
        "aprobadas" => $result[0],
        "reprobadas" => $result2[0],
        "retiradas" => $result3[0]
    );
    $contador++;
}
foreach ($json as $key => $value) {
    echo "<tr>
    <th scope='row'>" . $value['name'] . "</th>
    <th scope='row'>" . $value['aprobadas'] . "</th>
    <th scope='row'>" . $value['reprobadas'] . "</th>
    <th scope='row'>" . $value['retiradas'] . "</th>
  </tr>
  ";
}
