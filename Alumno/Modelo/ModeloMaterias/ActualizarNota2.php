<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
session_start();


// Obtenemos los datos de la variable POST
$cantidadMaterias = $_SESSION['cantidadMaterias'];
$idMateria=$_POST['materia']; // Posicion 0
$nota=$_POST['nota']; // Posicion 1
$estado=$_POST['estado']; // Posicion 2
$idInscripcionCiclo=$_POST['idInscripcionCiclo']; // Posicion 3
$idExpedienteU=$_POST['expedienteu']; // Posicion 4

if (!isset($_COOKIE['datosAlumnos'])){
    $datosAlumno = [$idMateria , $nota , $estado ];
    setcookie("datosAlumnos" , json_encode(array($datosAlumno)));

    $_SESSION['message'] = 'Nota agregada para actualizar. Esperamos a que guardes cambios.';
    $_SESSION['message2'] = 'success';
    header("Location: ../../ModificarInscripcio.php?id=$idInscripcionCiclo&idAlumno=$idExpedienteU");
}

if (isset($_COOKIE['datosAlumnos'])){
    $datosCookie = json_decode($_COOKIE['datosAlumnos']);

    $datosAux = array([$idMateria , $nota , $estado]);

    foreach ($datosCookie as $dato){
        if ($dato[0] != $idMateria){
            $datosAux[] = $dato;
        }
    }

    $_SESSION['message'] = 'Nota agregada para actualizar. Esperamos a que guardes cambios.';
    $_SESSION['message2'] = 'success';
    setcookie("datosAlumnos" , json_encode($datosAux));

    header("Location: ../../ModificarInscripcio.php?id=$idInscripcionCiclo&idAlumno=$idExpedienteU");
}

?>