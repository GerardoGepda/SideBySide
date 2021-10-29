<?php
//https://localhost/SideBySide/CoachReuniones/Modelo/ModeloRenovacion/CalcularRenovacion/calculate.php

    //incluimos la conexión a la BD
    include "../../../../Conexion/conexion.php";

    //inluimos el codigo que nos extraera el calulo de asistencia
    include "./getAttendance.php";

    //Declaración de variables
    $unis = array();
    $Classes = array();
    $Sedes = array();
    $alumnosHS = array();
    $alumnosAttendance = array();

    //--- EXTRAEMOS LAS UNIVERSIDADES, CLASES Y SEDES A TRABAJAR ---//
    $cicloActual = "02-2021";

    $sqlUnis = "SELECT DISTINCT ID_Empresa FROM alumnos WHERE StatusActual = 'Becado'";
    $sqlClasses = "SELECT DISTINCT Class FROM alumnos WHERE StatusActual = 'Becado'";
    $sqlSedes = "SELECT DISTINCT ID_Sede FROM alumnos WHERE StatusActual = 'Becado'";

    $query1 = $dbh->prepare($sqlUnis);
    $query1->execute();
    foreach ($query1->fetchAll(PDO::FETCH_NUM) as $key => $value) {
        array_push($unis, $value[0]);
    }

    $query2 = $dbh->prepare($sqlClasses);
    $query2->execute();
    foreach ($query2->fetchAll(PDO::FETCH_NUM) as $key => $value) {
        array_push($Classes, $value[0]);
    }

    $query3 = $dbh->prepare($sqlSedes);
    $query3->execute();
    foreach ($query3->fetchAll(PDO::FETCH_NUM) as $key => $value) {
        array_push($Sedes, $value[0]);
    }
    //--- //EXTRAEMOS LAS UNIVERSIDADES, CLASES Y SEDES A TRABAJAR ---//


    //--- EXTRAEMOS LOS ALUMNOS A LOS QUE SE LAS HA APROBADO LAS H. DE VINCULACIÓN ---//
    $sqlHS = "SELECT a.ID_Alumno as IdAlumno, a.Nombre as nombre, a.ID_Empresa as ID_Empresa FROM hsociales hs INNER JOIN alumnos a
    ON hs.ID_Alumno = a.ID_Alumno 
    WHERE hs.ID_Ciclo = :ciclo AND hs.estado = 'Aprobado'";

    $queryHS = $dbh->prepare($sqlHS);
    $queryHS->execute([":ciclo" => $cicloActual]);
    $alumnosHS = $queryHS->fetchAll(PDO::FETCH_ASSOC);
    //--- //EXTRAEMOS LOS ALUMNOS A LOS QUE SE LAS HA APROBADO LAS H. DE VINCULACIÓN ---//
    

    //--- EXTRAEMOS LOS ALUMNOS A LOS QUE SE HAN ASISTIDO A LAS REUNIONES REQUERIDAS ---//
    $alumnosAttendance = extractCantReu($unis, $cicloActual, $Classes, $Sedes, $dbh);
    //--- //EXTRAEMOS LOS ALUMNOS A LOS QUE SE HAN ASISTIDO A LAS REUNIONES REQUERIDAS ---//


    $sqlCicloNotas = "SELECT a.ID_Alumno, a.Nombre, cicloU, comprobante, pdfnotas FROM inscripcionciclos ic 
    INNER JOIN expedienteu eu
    ON ic.idExpedienteU = eu.idExpedienteU
    INNER JOIN alumnos a
    ON a.ID_Alumno = eu.ID_Alumno
    WHERE cicloU = 'Ciclo 02-2021'";

    
?>