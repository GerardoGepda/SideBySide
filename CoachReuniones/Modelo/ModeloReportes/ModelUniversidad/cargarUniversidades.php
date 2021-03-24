<?php
// incluir conexion
include "../../../../BaseDatos/conexion.php";
// ocultar errores
error_reporting(0);


// declaracion de variables
$json = array();
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

// consultas sql
$sql = "SELECT * FROM empresas WHERE Tipo = 'Universidad' ";

// ejecucion de consultas
$query = $pdo->prepare($sql);
$query->execute();
$cantidad = $query->rowCount();


// devolver datos como json
$data = array();

// recorrer consultas
while ($row = $query->fetch()) {
    $json[] = array( $row['Nombre']);
}


// resultado consultas 

$data["id"] = $cantidad;

for ($i=0; $i <$cantidad ; $i++) { 
    $data["name"] = $json[$i];
}

$data["aprobados"] = $cantidad;
$data["reprobados"] = $cantidad;
$data["retirados"] = $cantidad;

/*ahora lo imprimes 
IMPORTANTE !! IMPORTANTE !! IMPORTANTE !! IMPORTANTE !! 
No imprimas otra cosa más que la respuesta */

//Convertimos el array a JSON y lo imprimimos para que pueda recuperarlo el JS
$respuesta = json_encode($data);
echo $respuesta;